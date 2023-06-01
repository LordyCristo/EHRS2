<?php

namespace App\Http\Controllers;

use App\Http\Resources\fecalysisCollection;
use App\Http\Resources\fecalysisResource;
use App\Http\Resources\UserCollection;
use App\Models\Fecalysis;
use App\Models\FecalysisRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FecalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Laboratory/Fecalysis/FecalysisIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Laboratory/Fecalysis/FecalysisIndex',[
            'physicians' => new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get()),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return Inertia::render('Laboratory/Fecalysis/ViewFecalysis', [
            'data' => new fecalysisResource(FecalysisRecord::with('fecalysis')->with('rqstPhysician')->with('medicalTechnologist')->with('pathologist')->findOrFail($request->id)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Laboratory/Fecalysis/EditFecalysis', [
            'data' => new FecalysisResource(FecalysisRecord::join('fecalysis','fecalysis.id','=','fecalysis_records.id')->findOrFail($request->id)),
            'physicians' => new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get()),
        ]);
    }
}
