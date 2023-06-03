<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FecalysisRequest;
use App\Http\Resources\fecalysisCollection;
use App\Http\Resources\fecalysisResource;
use App\Models\Fecalysis;
use App\Models\FecalysisRecord;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FecalysisApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new FecalysisCollection(FecalysisRecord::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FecalysisRequest $request)
    {
        $newResult = Fecalysis::create($request->validated());
        if ($newResult){
            $request->merge(['fecalysis_id' => $newResult->id]);
            $newRecord = FecalysisRecord::create($request->all());
            if ($newRecord){
                return response()->json([
                    'data' => (new FecalysisResource($newRecord)),
                    'notification' => [
                        'id' => uniqid(),
                        'show' => true,
                        'type' =>'success',
                        'message' => 'Successfully created Fecalysis result with id '.$newRecord->id,
                    ]
                ])->setStatusCode(201);
            }
        }
        return response()->json([
            'data' => (new FecalysisResource($newResult)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' =>'failed',
                'message' => 'Failed to create Fecalysis record',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new FecalysisResource(Fecalysis::with('fecalysisRecord')->findOrFail($request->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FecalysisRequest $request)
    {
        $record = FecalysisRecord::findOrFail($request->id);
        $update = $record->update($request->validated());
        if ($update){
            $record->fecalysis->update($request->validated());
            return response()->json([
                'data' => (new FecalysisResource($record)),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully updated Fecalysis result with id '.$record->id,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => (new FecalysisResource($record)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to update Fecalysis record',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = explode(',', $request->id);

        $deletedRecordsCount = FecalysisRecord::destroy($ids);
        $deletedFecalysisCount = Fecalysis::whereIn('id', $ids)->delete();

        $success = ($deletedRecordsCount > 0 && $deletedFecalysisCount > 0);

        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $success ? 'success' : 'failed',
                'message' => $success ? "Successfully deleted {$deletedRecordsCount} Fecalysis record(s)." : "Failed to delete Fecalysis record(s) with ID {$request->id}.",
            ]
        ]);
    }


    /**
     * Get all the departments to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = FecalysisRecord::join('clients', 'fecalysis_records.infirmary_id', '=', 'clients.infirmary_id')
            ->selectRaw('fecalysis_records.*, CONCAT(clients.last_name, ", ", clients.first_name, " ", clients.middle_name) as name');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('fecalysis_records.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                } elseif ($searchBy == 'name'){
                    $q->where('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%');
                }
                else {
                    $q->where('fecalysis_records.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'fecalysis_records.id');
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

        $validator = new FecalysisRequest();

        foreach ($data as $row) {
            $validation = Validator::make($row, $validator->rules());

            if ($validation->fails()) {
                $failedCount++;
                $row['errors'] = $validation->errors();
                $response['data'][] = $row;
            } else {
                try {
                    $fecalysis = Fecalysis::create($row);
                    if($fecalysis){
                        $fecalysis->fecalysisRecord()->create($row);
                        $successCount++;
                    }
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
                'message' => !$failedCount?'Successfully imported Fecalysis without errors':'Failed to import Fecalysis '.$failedCount.' rows out of '.$failedCount+$successCount,
            ]
        ]);
    }
}
