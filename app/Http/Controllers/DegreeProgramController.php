<?php

namespace App\Http\Controllers;

use App\Http\Resources\DegreeProgramResource;
use App\Http\Resources\DepartmentCollection;
use App\Models\Degreeprogram;
use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DegreeProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MorePages/Programs/ProgramIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('MorePages/Programs/NewProgram',[
            'departments' => new DepartmentCollection(Department::all()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('MorePages/Programs/EditProgram', [
            'data' => new DegreeProgramResource(DegreeProgram::findOrFail($request->id)),
            'departments' => new DepartmentCollection(Department::all()),
        ]);
    }

}
