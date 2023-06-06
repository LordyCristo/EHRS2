<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RadiologyRequest;
use App\Http\Resources\XrayCollection;
use App\Models\Xray;
use App\Models\XrayRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RadiologyAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new XrayCollection(XrayRequest::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RadiologyRequest $request)
    {
        $newRecord = XrayRequest::create($request->validated());
        if ($newRecord){
            $request->merge(['rqst_id' => $newRecord->id]);
            $newRecord = $newRecord->xray()->create($request->all());
            if($newRecord) {
                return response()->json([
                    'data' => (new XrayCollection($newRecord)),
                    'notification' => [
                        'id' => uniqid(),
                        'show' => true,
                        'type' => 'success',
                        'message' => 'Successfully created Xray with id ' . $newRecord->id,
                    ]
                ])->setStatusCode(201);
            }
        }
        return response()->json([
            'data' => (new XrayCollection($newRecord)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to create Xray record',
            ]
        ])->setStatusCode(500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RadiologyRequest $request)
    {
        $record = XrayRequest::findOrFail($request->id);
        $record->update($request->validated());
        if ($record){
            $request->merge(['rqst_id' => $record->id]);
            $newRecord = $record->xray()->update($request->all());
            if($newRecord) {
                return response()->json([
                    'data' => (new XrayCollection($newRecord)),
                    'notification' => [
                        'id' => uniqid(),
                        'show' => true,
                        'type' => 'success',
                        'message' => 'Successfully updated Xray with id ' . $newRecord->id,
                    ]
                ])->setStatusCode(201);
            }
        }
        return response()->json([
            'data' => (new XrayCollection($record)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to update Xray record',
            ]
        ])->setStatusCode(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        XrayRequest::with('xray')->whereIn('id', $id)->delete();
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'success',
                'message' => 'Successfully deleted Xray with id ' . $request->id,
            ]
        ])->setStatusCode(200);
    }

    /**
     * Get all the xrays to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = XrayRequest::join('clients', 'xray_requests.infirmary_id', '=', 'clients.infirmary_id')
            ->selectRaw('xray_requests.*, CONCAT(clients.last_name, ", ", clients.first_name, " ", clients.middle_name) as name');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('xray_requests.id', 'like', '%' . $search . '%')
                        ->orwhere('xray_requests.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhereRaw('CONCAT(clients.last_name, ", ", clients.first_name, " ", clients.middle_name) LIKE ?', '%' . $search . '%')
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
