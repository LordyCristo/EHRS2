<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Models\Client;
use App\Models\DentalTreatment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DentalTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dentistry/DentalTreatment/DentalTreatmentIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dentistry/DentalTreatment/NewDentalTreatment',[
            'clients' => $this->getClients()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return Inertia::render('Dentistry/DentalTreatment/ShowDentalTreatment', [
            'dentalTreatment' => DentalTreatment::where('id', $request->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Dentistry/DentalTreatment/EditDentalTreatment', [
            'dentalTreatment' => DentalTreatment::where('id', $request->id)->get()
        ]);
    }

    private function getClients()
    {
        // get all clients
        return new ClientCollection(Client::join('dental_records', 'clients.infirmary_id', '=', 'dental_records.infirmary_id')
        ->selectRaw('dental_records.infirmary_id AS id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""),last_name, IFNULL(CONCAT(" ",suffix), ""))) as name, sex, age, birthdate')->orderBy('dental_records.infirmary_id')->get());
    }
}
