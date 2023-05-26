<?php

namespace App\Http\Controllers;

use App\Http\Resources\CollegeCollection;
use App\Http\Resources\DepartmentResource;
use App\Models\College;
use App\Models\DegreeProgram;
use App\Models\Department;
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
        return Inertia::render('MorePages/Departments/DepartmentIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('MorePages/Departments/NewDepartment',[
            'colleges' => new CollegeCollection(College::all()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('MorePages/Departments/EditDepartment', [
            'data' => new DepartmentResource(Department::find($request->id)),
            'colleges' => new CollegeCollection(College::all()),
        ]);
    }
}
