<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DegreeProgramRequest;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DegreeProgramCollection;
use App\Http\Resources\DegreeProgramResource;
use App\Models\DegreeProgram;
use Exception;
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
        return new DegreeProgramCollection(DegreeProgram::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DegreeProgramRequest $request)
    {
        $newDegreeProgram = DegreeProgram::create($request->all());
        return response()->json([
            'data' => (new DegreeProgramResource($newDegreeProgram)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $newDegreeProgram?'success':'failed',
                'message' => $newDegreeProgram?'Successfully created Program with id '.$newDegreeProgram->id:'Failed to create Program record',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new DegreeProgramResource(DegreeProgram::findOrFail($request->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DegreeProgramRequest $request)
    {
        $degreeprogram = DegreeProgram::findOrFail($request->id);
        $update = $degreeprogram->update($request->all());
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $update?'success':'failed',
                'message' => $update?'Successfully updated Program record id '.$request->id:'Failed to update Program record with id '. $request->id,
            ]
        ])->setStatusCode($update?202:400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        $temp = DegreeProgram::destroy($id);
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $temp?'success':'failed',
                'message' => $temp?'Successfully deleted '.$temp.' Program record/s':'Failed to delete Program record with id '. $request->id,
            ]
        ]);
    }

    /**
     * Get all the programs to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = DegreeProgram::join('departments','departments.id','=','degree_programs.department_id')->
        select(['degree_programs.id','degree_programs.name','degree_programs.abbr','degree_programs.major','degree_programs.group','departments.abbr as department_id','degree_programs.is_active']);
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('degree_programs.id', 'like', '%' . $search . '%')
                        ->orWhere('degree_programs.name', 'like', '%' . $search . '%')
                        ->orWhere('degree_programs.abbr', 'like', '%' . $search . '%')
                        ->orWhere('degree_programs.major', 'like', '%' . $search . '%')
                        ->orWhere('degree_programs.group', 'like', '%' . $search . '%')
                        ->orWhere('degree_programs.department_id', 'like', '%' . $search . '%')
                        ->orWhere('degree_programs.is_active', 'like', '%' . $search . '%')
                        ->orWhere('departments.abbr', 'like', '%' . $search . '%');
                } else {
                    if($searchBy == 'department_id')
                        $q->where('departments.abbr', 'like', '%' . $search . '%');
                    else
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
                'message' => !$failedCount?'Successfully imported Programs without errors':'Failed to import Programs '.$failedCount.' rows out of '.$failedCount+$successCount,
            ]
        ]);
    }
}
