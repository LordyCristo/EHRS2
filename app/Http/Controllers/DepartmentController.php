<?php

namespace App\Http\Controllers;

use App\Models\DegreeProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programs = DegreeProgram::select(['degree_programs.id', 'degree_programs.name', 'degree_programs.abbr', 'degree_programs.major', 'departments.name AS department_id'])
            ->leftJoin('departments', 'departments.id', '=', 'degree_programs.department_id');

        $searchBy = $request->input('search_by', 'name');
        // Handle search
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $programs->where(function ($query) use ($searchTerm, $searchBy) {
                if ($searchBy == '*') {
                    $query->where('degree_programs.name', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('degree_programs.abbr', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('degree_programs.major', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('departments.name', 'LIKE', '%' . $searchTerm . '%');
                } else {
                    $field = 'degree_programs.' . $searchBy; // dynamically generate the search field
                    $query->where($field, 'LIKE', '%' . $searchTerm . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('sort_dir', 'asc');
        $programs->orderBy($sortField, $sortDirection);

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $paginator = $programs->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            //get the total number of pages
            'totalPages' => $paginator->lastPage(),
            'hasMorePage' => $paginator->hasMorePages(),
            'totalCount' => $paginator->total(),
            'data' => $paginator->items(),
            'perPage' => $paginator->perPage(),
            'pageCount' => $paginator->perPage(),
            'prevPage' => $paginator->lastPage(),
            'currPage' => $paginator->currentPage(),
            'nextPage' => $paginator->nextPageUrl(),
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = [];
            foreach ($errors->keys() as $key) {
                $errorMessages[$key] = $errors->get($key)[0];
            }
            return inertia('Records/NewRecord', [
                'errors' => $errorMessages,
            ]);
        }
        DegreeProgram::create($request->all());
        return inertia('Records/RecordIndex', [
            'success' => 'Degree program successfully added',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('Radiology/EditRadiology');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $temp = DB::table('degree_programs')->where('id', $id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        if ($temp) {
            return inertia('Radiology/RadiologyDashboard', [
                'status' => 'success',
                'message' => 'Records deleted successfully',
                'data' => $temp,
            ]);
        }
        return inertia('Radiology/RadiologyDashboard', [
            'status' => 'failed',
            'message' => 'Unable to delete record',
        ]);
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:degree_programs'],
            'abbr' => ['required', 'string', 'max:255', 'unique:degree_programs'],
            'department_id' => ['required', 'exists:departments,id'],
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Program name is required',
            'name.string' => 'Program name must be a string',
            'name.max' => 'Program name must not exceed 255 characters',
            'name.unique' => 'Program name already exists',
            'abbr.required' => 'Program abbreviation is required',
            'abbr.string' => 'Program abbreviation must be a string',
            'abbr.max' => 'Program abbreviation must not exceed 255 characters',
            'abbr.unique' => 'Program abbreviation already exists',
            'department_id.required' => 'Program is required',
            'department_id.exists' => 'Program does not exist',
        ];
    }
}
