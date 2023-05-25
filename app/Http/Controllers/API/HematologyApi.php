<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\HematologyRequest;
use App\Http\Resources\HematologyCollection;
use App\Http\Resources\HematologyResource;
use App\Models\Hematology;
use App\Models\HematologyRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HematologyApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new HematologyCollection(HematologyRecord::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HematologyRequest $request)
    {
        $newHematology = Hematology::create($request->validated());
        if ($newHematology){
            $newRecord = HematologyRecord::create([
                'id' => $newHematology->id,
                'client_id' => $request->client_id,
                'age' => $request->age,
                'sex' => $request->sex,
                'ward' => $request->ward,
                'or_no' => $request->or_no,
                'rqst_physician' => $request->rqst_physician,
                'hospital_no' => $request->hospital_no,
            ]);
            if ($newRecord){
                return (new HematologyResource($newHematology))->response()->setStatusCode(201);
            }
        }
        return response()->setStatusCode(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(HematologyRecord $hematology)
    {
        return new HematologyResource($hematology);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HematologyRequest $request)
    {
        $hematology = Hematology::findOrFail($request->id);
        $update = $hematology->update($request->validated());
        if ($update)
            return response(null, 202);
        return response(null, 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        HematologyRecord::destroy($id);
        Hematology::destroy($id);
        // Return the success code
        return response()->json([
            'success' => true,
            'message' => 'Records deleted successfully',
            'data' => $id,
        ]);
    }

    /**
     * Get all the departments to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = HematologyRecord::with('hematology', 'client')->where('id', '!=', null);
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('id', 'like', '%' . $search . '%')
                        ->orWhere('client_id', 'like', '%' . $search . '%')
                        ->orWhere('age', 'like', '%' . $search . '%')
                        ->orWhere('sex', 'like', '%' . $search . '%')
                        ->orWhere('ward', 'like', '%' . $search . '%')
                        ->orWhere('or_no', 'like', '%' . $search . '%')
                        ->orWhere('rqst_physician', 'like', '%' . $search . '%')
                        ->orWhere('hospital_no', 'like', '%' . $search . '%');
                } else {
                    $q->where('hematology_records.' . $searchBy, 'like', '%' . $search . '%');
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

        $validator = new HematologyRequest();

        foreach ($data as $row) {
            $validation = Validator::make($row, $validator->rules());

            if ($validation->fails()) {
                $failedCount++;
                $row['errors'] = $validation->errors();
                $response['data'][] = $row;
            } else {
                try {
                    Hematology::create($row);
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
