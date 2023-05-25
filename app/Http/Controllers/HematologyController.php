<?php

namespace App\Http\Controllers;

use App\Models\Hematology;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HematologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Laboratory/Hematology/HematologyIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Laboratory/Hematology/NewHematology');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Laboratory/Hematology/EditHematology', [
            'data' => Hematology::findOrFail($request->id),
        ]);
    }
}
