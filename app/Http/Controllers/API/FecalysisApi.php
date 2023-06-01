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
        $newFecalysis = Fecalysis::create($request->validated());
        if ($newFecalysis){
            $newRecord = FecalysisRecord::create([
                'fecalysis_id' => $newFecalysis->id,
                'infirmary_id' => $request->infirmary_id,
                'age' => $request->age,
                'sex' => $request->sex,
                'ward' => $request->ward,
                'or_no' => $request->or_no,
                'rqst_physician' => $request->rqst_physician,
                'medical_technologist' => $request->medical_technologist,
                'pathologist' => $request->pathologist,
                'hospital_no' => $request->hospital_no,
                'status' =>  $request->status,
            ]);
            if ($newRecord){
                return response()->json([
                    'data' => (new FecalysisResource($newRecord)),
                    'notification' => [
                        'id' => uniqid(),
                        'show' => true,
                        'type' =>'success',
                        'message' => 'Successfully created Fecalysis with id '.$newRecord->id,
                    ]
                ])->setStatusCode(201);
            }
        }
        return response()->json([
            'data' => (new FecalysisResource($newFecalysis)),
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
        $fecalysisRecord = FecalysisRecord::findOrFail($request->id);
        $update = $fecalysisRecord->update($request->validated());
        if ($update){
            $fecalysisRecord->fecalysis->update($request->validated());
            return response()->json([
                'data' => (new FecalysisResource($fecalysisRecord)),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully updated Fecalysis with id '.$fecalysisRecord->id,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => (new FecalysisResource($fecalysisRecord)),
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
        $id = explode(',', $request->id);
        FecalysisRecord::destroy($id);
        $temp = Fecalysis::destroy($id);
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $temp?'success':'failed',
                'message' => $temp?'Successfully deleted '.$temp.' Fecalysis record/s':'Failed to delete Fecalysis record with id '. $request->id,
            ]
        ]);
    }

    /**
     * Get all the departments to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = FecalysisRecord::with('fecalysis')->where('id', '!=', null);
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('id', 'like', '%' . $search . '%')
                        ->orWhere('infirmary_id', 'like', '%' . $search . '%')
                        ->orWhere('age', 'like', '%' . $search . '%')
                        ->orWhere('sex', 'like', '%' . $search . '%')
                        ->orWhere('ward', 'like', '%' . $search . '%')
                        ->orWhere('or_no', 'like', '%' . $search . '%')
                        ->orWhere('rqst_physician', 'like', '%' . $search . '%')
                        ->orWhere('hospital_no', 'like', '%' . $search . '%');
                } else {
                    $q->where('fecalysis_records.' . $searchBy, 'like', '%' . $search . '%');
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
                        if ($fecalysis){
                            $successCount++;
                        }else{
                            $fecalysis->delete();
                            $failedCount++;
                        }
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
