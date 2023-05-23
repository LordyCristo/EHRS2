<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DegreeProgramRequest;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DegreeProgramCollection;
use App\Http\Resources\DegreeProgramResource;
use App\Models\DegreeProgram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DegreeProgramApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DegreeProgramCollection::collection(DegreeProgram::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DegreeProgramRequest $request)
    {
        $newDegreeProgram = DegreeProgram::create($request->all());
        return (new DegreeProgramResource($newDegreeProgram))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Degreeprogram $degreeprogram)
    {
        return new DegreeProgramResource($degreeprogram);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DegreeProgramRequest $request)
    {
        $degreeprogram = DegreeProgram::findOrFail($request->id);
        $update = $degreeprogram->update($request->all());
        if ($update)
            return response(null, 202);
        return response(null, 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $degreeProgram = DegreeProgram::findOrFail($request->id);
        $degreeProgram->delete();
        // return the success code
        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully'
        ]);
    }

    /**
     * Get all the programs to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = DegreeProgram::select(['id','name','abbr','major','group','department_id','is_active']);
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('id', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('abbr', 'like', '%' . $search . '%')
                        ->orWhere('major', 'like', '%' . $search . '%')
                        ->orWhere('group', 'like', '%' . $search . '%')
                        ->orWhere('department_id', 'like', '%' . $search . '%')
                        ->orWhere('is_active', 'like', '%' . $search . '%');
                } else {
                    $q->where('degree_programs.' . $searchBy, 'like', '%' . $search . '%');
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
     * Import the data from the csv file.
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

        $validator = new DegreeProgramRequest();

        foreach ($data as $row) {
            $validation = Validator::make($row, $validator->rules());

            if ($validation->fails()) {
                $failedCount++;
                $row['errors'] = $validation->errors();
                $response['data'][] = $row;
            } else {
                try {
                    DegreeProgram::create($row);
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
