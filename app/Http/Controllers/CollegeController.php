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
        return Inertia::render('MorePages/Colleges/CollegeIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('MorePages/Colleges/NewCollege');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('MorePages/Colleges/EditCollege', [
            'data' => College::findOrFail($request->id),
        ]);
    }

}
