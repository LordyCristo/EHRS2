<?php

namespace App\Http\Controllers;

use App\Models\DegreeProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return inertia('Records/RecordDashboard', [
            'success' => 'Degree program successfully added',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
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
