<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RadiologyRequestRequest;
use App\Http\Resources\XrayRequestCollection;
use App\Http\Resources\XrayRequestResource;
use App\Models\XrayRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RadiologyRequestApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new XrayRequestCollection(XrayRequest::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RadiologyRequestRequest $request)
    {
        $newRecord = XrayRequest::create($request->all());
        if ($newRecord) {
            return response()->json([
                'data' => (new XrayRequestResource($newRecord)),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully created Xray Request with id ' . $newRecord->id,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => (new XrayRequestResource($newRecord)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to create Xray Request record',
            ]
        ])->setStatusCode(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new XrayRequestResource(XrayRequest::findOrFail($request->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RadiologyRequestRequest $request)
    {
        $record = XrayRequest::findOrFail($request->id);
        $record->update($request->all());
        return response()->json([
            'data' => (new XrayRequestResource($record)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'success',
                'message' => 'Successfully updated Xray Request with id ' . $record->id,
            ]
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        $record = XrayRequest::destroy($id);
        if ($record) {
            return response()->json([
                'data' => (new XrayRequestResource($record)),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully deleted Xray Request with id ' . $record->id,
                ]
            ])->setStatusCode(200);
        }
        return response()->json([
            'data' => (new XrayRequestResource($record)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to delete Xray Request record',
            ]
        ])->setStatusCode(500);
    }

    /**
     * Get all the xrays to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = XrayRequest::join('clients', 'xray_requests.infirmary_id', '=', 'clients.infirmary_id')
            ->selectRaw('xray_requests.*, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('xray_requests.id', 'like', '%' . $search . '%')
                        ->orwhere('xray_requests.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhereRaw('CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(" ",clients.suffix, "")) LIKE ?', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                } elseif ($searchBy == 'name'){
                    $q->where('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%');
                } else {
                    $q->where('xray_requests.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'xray_requests.id');
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
