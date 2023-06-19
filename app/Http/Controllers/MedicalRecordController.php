<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicalRecordResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Records/RecordIndex');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return Inertia::render('Records/ViewRecord',[
            'data' => new MedicalRecordResource(Client::with(['hematology' => function ($query) {
                    $query->orderBy('created_at', 'desc')->first();
                }])
                ->with(['fecalysis' => function ($query) {
                    $query->orderBy('created_at', 'desc')->first();
                }])
                ->with(['urinalysis' => function ($query) {
                    $query->orderBy('created_at', 'desc')->first();
                }])
                ->with(['xray' => function ($query) {
                    $query->orderBy('created_at', 'desc')->first();
                }])
                ->with(['dental' => function ($query) {
                    $query->orderBy('created_at', 'desc')->first();
                }])
                ->with(['medicalCertificate' => function ($query) {
                    $query->orderBy('created_at', 'desc')->first();
                }])
                ->with(['physicalExam' => function ($query) {
                    $query->orderBy('created_at', 'desc')->first();
                }])
                ->selectRaw('clients.*,CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name')
                ->find($request->id))
        ]);
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
}
