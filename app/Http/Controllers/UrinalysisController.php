<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UrinalysisResource;
use App\Http\Resources\UserCollection;
use App\Models\Client;
use App\Models\UrinalysisRecord;
use App\Models\PaymentsService;
use App\Models\Urinalysis;
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
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getOrNos(),
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
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getOrNos(),
        ]);
    }

    /**
     * Get all the client infirmary id and name who has paid for urinalysis service but hasn't been used in urinalysis records
     */
    private function getClients()
    {
        // get all clients
        return new ClientCollection(Client::selectRaw("infirmary_id AS id, CONCAT(infirmary_id, ' - ', first_name, ' ', last_name) AS name")->get());

//        return new ClientCollection(Client::join('payments', 'payments.infirmary_id', '=', 'clients.infirmary_id')
//            ->join('payments_service', 'payments_service.payment_id', '=', 'payments.id')
//            ->leftJoin('urinalysis_records', function ($join) {
//                $join->on('urinalysis_records.or_no', '=', 'payments_service.payment_id')
//                    ->whereNull('urinalysis_records.or_no');
//            })
//            ->where('payments_service.service_id', 1)
//            ->selectRaw("clients.infirmary_id AS id, CONCAT(clients.infirmary_id, ' - ', clients.first_name, ' ', clients.last_name) AS name")
//            ->groupBy('clients.infirmary_id')
//            ->get());
    }

    /**
     * Get all the or_no that is for urinalysis service and hasn't been used in urinalysis records
     */
    public function getOrNos()
    {
        return new PaymentCollection(PaymentsService::join('payments', 'payments_service.payment_id', '=', 'payments.id')
            ->join('clients', 'clients.infirmary_id', '=', 'payments.infirmary_id')
            ->leftJoin('fees', 'payments_service.service_id', '=', 'fees.service_id')
            ->leftJoin('services', 'services.id', '=', 'fees.service_id')
            ->selectRaw("payments_service.payment_id AS id, CONCAT(payments_service.payment_id, ' - ', clients.infirmary_id) AS name")
            ->where('services.section_name', 'LIKE', '%Laboratory%')
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
