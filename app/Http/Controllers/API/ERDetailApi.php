<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ERDetailsRequest;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\ERDetail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ERDetailApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ClientCollection(Client::join('er_details','er_details.infirmary_id','=','clients.infirmary_id')->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new ClientResource(Client::findOrFail($request->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        $temp = Client::destroy($id);
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $temp?'success':'failed',
                'message' => $temp?'Successfully deleted '.$temp.' Client record/s':'Failed to delete Client record with id '. $request->id,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ERDetailsRequest $request)
    {
        $update = ERDetail::findOrFail($request->id);
        $update->update($request->all());

        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $update?'success':'failed',
                'message' => $update?'Successfully updated Client record id '.$request->id:'Failed to update Client record with id '. $request->id,
            ]
        ])->setStatusCode($update?202:400);
    }

    /**
     * Get all the Clients to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = Client::join('degree_programs','degree_programs.id','=','clients.program_id')
            ->join('client_types','client_types.id','=','clients.client_type_id')
            ->join('er_details','er_details.infirmary_id','=','clients.infirmary_id')
            ->selectRaw('clients.*, degree_programs.abbr as program_name, client_types.name as client_type, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as fullname');        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('clients.id', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.suffix', 'like', '%' . $search . '%')
                        ->orWhere('clients.age', 'like', '%' . $search . '%')
                        ->orWhere('clients.sex', 'like', '%' . $search . '%')
                        ->orWhere('clients.civil_status', 'like', '%' . $search . '%')
                        ->orWhere('client_types.name', 'like', '%' . $search . '%')
                        ->orWhere('degree_programs.abbr', 'like', '%' . $search . '%');
                } else if($searchBy == 'client_type'){
                    $q->where('client_types.name', 'like', '%' . $search . '%');
                } else if ($searchBy == 'program_name'){
                    $q->where('degree_programs.abbr', 'like', '%' . $search . '%');
                } else{
                    $q->where('clients.'.$searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('sort_dir', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $paginator->items(),
            'totalCount' => $paginator->total(),
            'totalPages' => $paginator->lastPage(),
            'perPage' => $paginator->perPage(),
            'totalRecords' => $totalRecords,
        ]);
    }

    public function import(Request $request): JsonResponse
    {
        $data = $request->all();
        $successCount = 0;
        $failedCount = 0;
        $response = [
            'successCount' => 0,
            'failedCount' => 0,
            'data' => [],
        ];

        $validator = new ClientRequest();

        foreach ($data as $row) {
            $validation = Validator::make($row, $validator->rules());

            if ($validation->fails()) {
                $failedCount++;
                $row['errors'] = $validation->errors();
                $response['data'][] = $row;
            } else {
                try {
                    Client::create($row);
                    $successCount++;
                } catch (Exception $e) {
                    $failedCount++;
                }
            }
        }

        $response['successCount'] = $successCount;
        $response['failedCount'] = $failedCount;
        return response()->json([
            $response,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => !$failedCount?'success':'warning',
                'message' => !$failedCount?'Successfully imported Clients without errors':'Failed to import Clients '.$failedCount.' rows out of '.$failedCount+$successCount,
            ]
        ]);
    }
}
