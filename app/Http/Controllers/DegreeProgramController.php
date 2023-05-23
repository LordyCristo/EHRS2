<?php

namespace App\Http\Controllers;

use App\Models\Degreeprogram;
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
        return Inertia::render('MorePages/Programs/NewProgram');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('MorePages/Programs/EditProgram', [
            'data' => DegreeProgram::findOrFail($request->id),
        ]);
    }

}
