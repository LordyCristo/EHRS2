<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\LaboratoryResource;
use App\Http\Resources\UserCollection;
use App\Models\Client;
use App\Models\LaboratoryRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LaboratoryRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Laboratory/Request/LaboratoryRequestIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Laboratory/Request/NewLaboratoryRequest',[
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getPatients(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new LaboratoryResource(LaboratoryRequest::with('patient')->with('physician')->findOrFail($request->id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Laboratory/Request/EditLaboratoryRequest',[
            'data' => new LaboratoryResource(LaboratoryRequest::findOrFail($request->id)),
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getPatients(),
        ]);
    }


    public function getPhysicians()
    {
        return new UserCollection(User::selectRaw('id, CONCAT(first_name, " ", last_name) as name')->where('role',1)->get());
    }

    public function getPatients()
    {
        return new ClientCollection(Client::selectRaw("infirmary_id AS id, CONCAT(first_name, ' ', last_name) AS name, age, sex")->get());
    }
}
