<?php

namespace App\Http\Controllers;

use App\Http\Resources\UrinalysisResource;
use App\Http\Resources\UserCollection;
use App\Models\Urinalysis;
use App\Models\UrinalysisRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UrinalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Laboratory/Urinalysis/UrinalysisIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Laboratory/Urinalysis/NewUrinalysis', [
            'physicians' => new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get()),
        ]);
    }

    /**
     * Show the view for printing a resource.
     */
    public function show(Request $request){
        return Inertia::render('Laboratory/Urinalysis/ViewUrinalysis',[
            'data' => new UrinalysisResource(UrinalysisRecord::with('client')->with('urinalysis')->with('rqstPhysician')->with('medicalTechnologist')->with('pathologist')->findOrFail($request->id)),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Laboratory/Urinalysis/EditUrinalysis',[
            'data' => new UrinalysisResource(UrinalysisRecord::join('urinalysis', 'urinalysis.id', '=', 'urinalysis_records.id')->findOrFail($request->id)),
            'physicians' => new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get()),
        ]);
    }
}
