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

class ServiceApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceCollection::collection(Services::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $newService = Services::create($request->all());
        return (new ServiceCollection($newService))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        return new ServiceResource($services);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request)
    {
        $service = Services::findOrFail($request->id);
        $update = $service->update($request->all());
        if ($update)
            return response(null, 202);
        return response(null, 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $service = Services::findOrFail($request->id);
        $service->delete();
        // return the success code
        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully'
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
}
