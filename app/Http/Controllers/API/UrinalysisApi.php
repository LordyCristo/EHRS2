<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrinalysisRequest;
use App\Http\Resources\UrinalysisCollection;
use App\Http\Resources\UrinalysisResource;
use App\Models\LaboratoryRequest;
use App\Models\Urinalysis;
use App\Models\UrinalysisRecord;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrinalysisApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UrinalysisCollection(UrinalysisRecord::join('urinalysis', 'urinalysis.id', '=','urinalysis_records.urinalysis_id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrinalysisRequest $request)
    {
        $newUrinalysis = Urinalysis::create($request->validated());
        if ($newUrinalysis){
            $request->merge(['urinalysis_id' => $newUrinalysis->id]);
            $newRecord = $newUrinalysis->urinalysisRecord()->create($request->validated());
            if ($newRecord){
                LaboratoryRequest::find($request->rqst_id)->update(['status' => 'done']);
                return response()->json([
                    'data' => (new UrinalysisResource($newRecord)),
                    'notification' => [
                        'id' => uniqid(),
                        'show' => true,
                        'type' => 'success',
                        'message' => 'Successfully created Urinalysis with id '.$newRecord->id,
                    ]
                ])->setStatusCode(201);
            }
        }
        return response()->json([
            'data' => (new UrinalysisResource($newUrinalysis)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to create Urinalysis record',
            ]
        ])->setStatusCode(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new UrinalysisResource(Urinalysis::with('urinalysisRecord')->findOrFail($request->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UrinalysisRequest $request)
    {
        $urinalysisRecord = UrinalysisRecord::findOrFail($request->id);
        $update = $urinalysisRecord->update($request->validated());
        if ($update){
            $urinalysisRecord->urinalysis->update($request->validated());
            return response()->json([
                'data' => (new UrinalysisResource($urinalysisRecord)),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully updated Urinalysis with id '.$urinalysisRecord->id,
                ]
            ])->setStatusCode(200);
        }
        return response()->json([
            'data' => (new UrinalysisResource($urinalysisRecord)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to update Urinalysis record',
            ]
        ])->setStatusCode(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        UrinalysisRecord::destroy($id);
        $temp = Urinalysis::destroy($id);
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $temp?'success':'failed',
                'message' => $temp?'Successfully deleted '.$temp.' Urinalysis record/s':'Failed to delete Urinalysis record with id '. $request->id,
            ]
        ]);
    }

    /**
     * Get all the departments to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = UrinalysisRecord::join('clients', 'urinalysis_records.infirmary_id', '=', 'clients.infirmary_id')
            ->selectRaw('urinalysis_records.*, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('urinalysis_records.infirmary_id', 'like', '%' . $search . '%')
                        ->orwhere('urinalysis_records.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhereRaw('CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) LIKE ?', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                } elseif ($searchBy == 'name'){
                    $q->where('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%');
                } else {
                    $q->where('urinalysis_records.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'urinalysis_records.id');
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
        $response = [
            'successCount' => 0,
            'failedCount' => 0,
            'data' => [],
        ];

        $validator = new UrinalysisRequest();

        foreach ($data as $row) {
            $validation = Validator::make($row, $validator->rules());

            if ($validation->fails()) {
                $row['errors'] = $validation->errors();
                $response['data'][] = $row;
                $response['failedCount']++;
            } else {
                try {
                    $urinalysis = Urinalysis::create($row);
                    $urinalysisRecord = $urinalysis->urinalysisRecord()->create($row);

                    if ($urinalysis && $urinalysisRecord) {
                        $response['successCount']++;
                    } else {
                        $response['failedCount']++;
                        if ($urinalysis) {
                            $urinalysis->delete();
                        }
                    }
                } catch (Exception $e) {
                    $response['failedCount']++;
                }
            }
        }

        $notificationType = $response['failedCount'] > 0 ? 'warning' : 'success';
        $notificationMessage = $response['failedCount'] > 0 ? "Failed to import Urinalysis {$response['failedCount']} rows out of " . ($response['failedCount'] + $response['successCount']) : 'Successfully imported Urinalysis without errors';

        $notification = [
            'id' => uniqid(),
            'show' => true,
            'type' => $notificationType,
            'message' => $notificationMessage,
        ];

        return response()->json([$response, 'notification' => $notification]);
    }
}
