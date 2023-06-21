<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaboratoryRequest;
use App\Http\Requests\LaboratoryRequest as LaboratoryRequestRequest;
use App\Http\Resources\LaboratoryCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LaboratoryRequestApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new LaboratoryCollection(LaboratoryRequest::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaboratoryRequestRequest $request)
    {
        $record = LaboratoryRequest::create($request->validated());
        return response()->json([
            'data' => $record,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'success',
                'message' => 'Successfully created Laboratory Request with id '.$record->id,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LaboratoryRequestRequest $request)
    {
        $record = LaboratoryRequest::find($request->id);
        $record->update($request->validated());
        return response()->json([
            'data' => $record,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'success',
                'message' => 'Successfully updated Laboratory Request with id '.$record->id,
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $record = LaboratoryRequest::find($request->id);
        $record->delete();
        return response()->json([
            'data' => $record,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'success',
                'message' => 'Successfully deleted Laboratory Request with id '.$record->id,
            ]
        ]);
    }

    public function tableApi(Request $request): JsonResponse
    {
        $query = \App\Models\LaboratoryRequest::join('clients', 'laboratory_requests.infirmary_id', '=', 'clients.infirmary_id')
            ->selectRaw('laboratory_requests.*, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('laboratory_requests.id', 'like', '%' . $search . '%')
                        ->orwhere('laboratory_requests.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhereRaw('CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) LIKE ?', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                } elseif ($searchBy == 'name'){
                    $q->where('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%');
                } else {
                    $q->where('laboratory_requests.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'laboratory_requests.id');
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
}
