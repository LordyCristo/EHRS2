<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ServiceResource;
use App\Models\Department;
use App\Models\Services;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ServiceCollection(Services::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $newService = Services::create($request->all());
        return response()->json([
            'data' => (new ServiceResource($newService)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $newService?'success':'failed',
                'message' => $newService?'Successfully created Service with id '.$newService->id:'Failed to create Service record',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new ServiceResource(Services::findOrFail($request->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request)
    {
        $service = Services::findOrFail($request->id);
        // check if the values are different
        if ($service->name == $request->name && $service->description == $request->description && $service->schedule == $request->schedule && $service->section_name == $request->section_name && $service->room_no == $request->room_no) {
            return response()->json([
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'warning',
                    'message' => 'No changes were made to Service record with id '.$request->id,
                ]
            ])->setStatusCode(200);
        }
        $update = $service->update($request->all());
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $update?'success':'failed',
                'message' => $update?'Successfully updated Service record id '.$request->id:'Failed to update Service record with id '. $request->id,
            ]
        ])->setStatusCode($update?202:400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $id = explode(',', $request->id);
        $temp = Services::destroy($id);
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $temp?'success':'failed',
                'message' => $temp?'Successfully deleted '.$temp.' Service record/s':'Failed to delete Service record with id '. $request->id,
            ]
        ]);
    }

    /**
     * Get all the services to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = Services::select(['id','name','description','schedule','section_name','room_no','is_active']);
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('id', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('schedule', 'like', '%' . $search . '%')
                        ->orWhere('section_name', 'like', '%' . $search . '%')
                        ->orWhere('room_no', 'like', '%' . $search . '%')
                        ->orWhere('is_active', 'like', '%' . $search . '%');
                } else {
                    $q->where('services.' . $searchBy, 'like', '%' . $search . '%');
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

        $validator = new ServiceRequest();

        foreach ($data as $row) {
            $validation = Validator::make($row, $validator->rules());

            if ($validation->fails()) {
                $failedCount++;
                $row['errors'] = $validation->errors();
                $response['data'][] = $row;
            } else {
                try {
                    Services::create($row);
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
                'message' => !$failedCount?'Successfully imported Services without errors':'Failed to import Services '.$failedCount.' rows out of '.$failedCount+$successCount,
            ]
        ]);
    }
}
