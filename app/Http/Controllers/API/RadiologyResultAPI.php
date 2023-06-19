<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RadiologyRequestRequest;
use App\Http\Requests\RadiologyResultRequest;
use App\Http\Resources\XrayCollection;
use App\Http\Resources\XrayResource;
use App\Models\Xray;
use App\Models\XrayRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RadiologyResultAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new XrayCollection(Xray::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RadiologyResultRequest $request)
    {
        $newRecord = Xray::create($request->validated());
        if ($newRecord) {
            $image = $request->image;
//            $imagePath = $image->getPathname();
//            $encoded_image = base64_encode(file_get_contents($imagePath));
            $temp = $newRecord->radiograph()->create([
                'xray_id' => $newRecord->id,
                'image' => $image,
            ]);
            if (!$temp) {
                return response()->json([
                    'data' => (new XrayResource($request->all())),
                    'notification' => [
                        'id' => uniqid(),
                        'show' => true,
                        'type' => 'failed',
                        'message' => 'Failed to upload X-ray image',
                    ]
                ])->setStatusCode(500);
            }
            // change the status of the xray request to done
            //find the xray request
            $xrayRequest = XrayRequest::findOrFail($request->rqst_id);
            // update the status
            $xrayRequest->update([
                'status' => 'done',
            ]);

            return response()->json([
                'data' => (new XrayResource($request->all())),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully created Xray with id ' . $newRecord->id,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => (new XrayResource($newRecord)),
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
    public function update(RadiologyResultRequest $request)
    {
        $record = XrayRequest::findOrFail($request->rqst_id);
        if ($record->xray()->update($request->validated())) {
            return response()->json([
                'data' => (new XrayResource($record)),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully updated Xray with id ' . $record->id,
                ]
            ])->setStatusCode(201);
        }

        return response()->json([
            'data' => (new XrayResource($record)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'warning',
                'message' => 'Failed to update Xray record',
            ]
        ])->setStatusCode(200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        //permanent delete the xray result
        $temp =DB::table('xrays')->whereIn('rqst_id', $id)->delete();
        if($temp) {
            // change the status of the xray request to pending
            //find all the xray request
            $xrayRequest = XrayRequest::whereIn('id', $id);
            // update all the status
            $xrayRequest->update([
                'status' => 'pending',
            ]);
            return response()->json([
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully deleted X-ray with id ' . $request->id,
                ]
            ])->setStatusCode(200);
        }
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'warning',
                'message' => 'Failed to delete X-ray result due dependency',
            ]
        ])->setStatusCode(200);
    }

    /**
     * Get all the xrays to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = Xray::join('xray_requests', 'xrays.rqst_id', '=', 'xray_requests.id')
            ->join('clients', 'xray_requests.infirmary_id', '=', 'clients.infirmary_id')
            ->selectRaw('xray_requests.*, xrays.rqst_id, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('xray_requests.id', 'like', '%' . $search . '%')
                        ->orwhere('xray_requests.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhereRaw('CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) LIKE ?', '%' . $search . '%')
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
