<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\Http\Resources\FeeCollection;
use App\Http\Resources\FeeResource;
use App\Models\Fees;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new FeeCollection(Fees::join('client_types', 'client_types.id', '=', 'fees.client_type')
            ->join('services', 'services.id', '=', 'fees.service_id')
            ->select('fees.id', 'services.name as service_name', 'fees.client_type', 'client_types.name as client_type_name', 'fees.amount', 'fees.created_at', 'fees.updated_at', 'fees.deleted_at')
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeeRequest $request)
    {
        $newFee =  Fees::create($request->all());
        $isCreated = $newFee->exists();

        return response()->json([
            'data' => (new FeeResource($newFee)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $isCreated ? 'success' : 'warning',
                'message' => $isCreated ? 'Successfully created Fee with id '.$newFee->id : 'Failed to create Fee record',
            ]
        ])->setStatusCode(201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new FeeResource(Fees::findOrFail($request->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeeRequest $request)
    {
        $fee = Fees::findOrFail($request->id);
        // check if the values are different
        if ($fee->service_id == $request->service_id && $fee->client_type == $request->client_type && $fee->amount == $request->amount) {
            return response()->json([
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'warning',
                    'message' => 'No changes were made to Fee record with id '.$request->id,
                ]
            ])->setStatusCode(200);
        }
        $update = $fee->update($request->all());
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $update?'success':'failed',
                'message' => $update?'Successfully updated Fee record id '.$request->id:'Failed to update Fee record with id '. $request->id,
            ]
        ])->setStatusCode($update?202:400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        $temp = Fees::destroy($id);
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $temp?'success':'failed',
                'message' => $temp?'Successfully deleted '.$temp.' Fee record/s':'Failed to delete Fee record with id '. $request->id,
            ]
        ]);
    }

    /**
     * Get all the fees to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = Fees::select('fees.id','fees.service_id', 'client_types.name as client_type', 'services.name as service', 'fees.amount')
            ->join('client_types', 'client_types.id', '=', 'fees.client_type')
            ->join('services', 'services.id', '=', 'fees.service_id');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('fees.id', 'like', '%' . $search . '%')
                        ->orWhere('client_types.name', 'like', '%' . $search . '%')
                        ->orWhere('services.name', 'like', '%' . $search . '%')
                        ->orWhere('fees.amount', 'like', '%' . $search . '%');
                } else {
                    $q->where('fees.' . $searchBy, 'like', '%' . $search . '%');
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

    /**
     * Import the departments from the csv file.
     */
    public function import(Request $request): JsonResponse
    {
        $data = $request->all();
        $successCount = 0;
        $failedCount = 0;
        $response = [
            'successCount' => 0,
            'failedCount' => null,
            'data' => [],
        ];

        $validator = new FeeRequest();

        foreach ($data as $row) {
            $validation = Validator::make($row, $validator->rules());

            if ($validation->fails()) {
                $failedCount++;
                $row['errors'] = $validation->errors();
                $response['data'][] = $row;
            } else {
                try {
                    Fees::create($row);
                    $successCount++;
                } catch (Exception $e) {
                    $failedCount++;
                    throw $e;
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
                'message' => !$failedCount?'Successfully imported Fee without errors':'Failed to import Fee '.$failedCount.' rows out of '.$failedCount+$successCount,
            ]
        ]);
    }
}
