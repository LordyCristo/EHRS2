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
            ->join('services', 'services.id', '=', 'fees.id')
            ->select('fees.id', 'services.name as service_name', 'fees.client_type', 'client_types.name as client_type_name', 'fees.amount', 'fees.created_at', 'fees.updated_at', 'fees.deleted_at')
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeeRequest $request)
    {
        $newFee =  Fees::create($request->all());
        return (new FeeResource($newFee))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fees $fees)
    {
        return new FeeResource($fees);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeeRequest $request)
    {
        $fee = Fees::findOrFail($request->id);
        $fee->update($request->all());
        if ($fee)
            return response(null, 202);
        return response(null, 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $fee = Fees::findOrFail($request->id);
        $fee->delete();
        // return the success code
        return response()->json([
            'success' => true,
            'message' => 'Fee deleted successfully'
        ]);
    }

    /**
     * Get all the departments to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = Fees::select('fees.id', 'client_types.name as client_type', 'services.name as service', 'fees.amount')
            ->join('client_types', 'client_types.id', '=', 'fees.client_type')
            ->join('services', 'services.id', '=', 'fees.id');
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
        return response()->json($response);
    }
}
