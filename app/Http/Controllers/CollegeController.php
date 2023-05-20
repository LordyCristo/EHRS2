<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MorePages/Colleges/CollegeIndex', [
            'data' => College::all(),
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
     * Show the form for editing the specified resource.
     */
    public function edit(College $college)
    {
        return Inertia::render('MorePages/Colleges/EditCollege', [
            'data' => $college,
        ]);
    }

}
