<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\DentalResource;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Models\Client;
use App\Models\DentalRecord;
use App\Models\PaymentsService;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dentistry/DentalRecord/DentalRecordIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dentistry/DentalRecord/NewDentalRecord',[
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getOrNos(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return Inertia::render('Dentistry/DentalRecord/ViewDentalRecord',[
            'data' => new DentalResource(DentalRecord::with('client')->with('dental')->with('dentist')->with('payment')->findOrFail($request->id)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Dentistry/DentalRecord/EditDentalRecord',[
            'data' => new DentalResource(DentalRecord::join('dentals', 'dental_records.dental_result_id', '=', 'dentals.id')
                ->selectRaw('dental_records.*, dentals.*')
                ->findOrFail($request->id)),
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getOrNos(),
        ]);
    }

    /**
     * Get all the client infirmary id and name who has paid for fecalysis service but hasn't been used in fecalysis records
     */
    private function getClients()
    {
        // get all clients
        return new ClientCollection(Client::selectRaw("infirmary_id AS id, CONCAT(infirmary_id, ' - ', first_name, ' ', last_name) AS name")->get());
    }

    /**
     * Get all the or_no that is for fecalysis service and hasn't been used in fecalysis records
     */
    public function getOrNos()
    {
        return new PaymentCollection(PaymentsService::join('payments', 'payments_service.payment_id', '=', 'payments.id')
            ->join('clients', 'clients.infirmary_id', '=', 'payments.infirmary_id')
            ->leftJoin('services', 'payments_service.service_id', '=', 'services.id')
            ->selectRaw("payments_service.payment_id AS id, CONCAT(payments_service.payment_id, ' - ', clients.infirmary_id) AS name")
            ->where('services.section_name', 'LIKE', '%Dental  Section%')
            ->get());
    }

    /**
     * Get all the physicians
     */
    public function getPhysicians()
    {
        return new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get());
    }
}
