<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Http\Resources\fecalysisCollection;
use App\Http\Resources\fecalysisResource;
use App\Http\Resources\LaboratoryCollection;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Models\Fecalysis;
use App\Models\FecalysisRecord;
use App\Models\LaboratoryRequest;
use App\Models\Payment;
use App\Models\Client;
use App\Models\PaymentsService;
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
        return Inertia::render('Laboratory/Fecalysis/NewFecalysis',[
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getUnsedOrNos(),
            'requests' => $this->getRequests(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return Inertia::render('Laboratory/Fecalysis/ViewFecalysis', [
            'data' => new fecalysisResource(FecalysisRecord::with('client')->with('fecalysis')->with('rqstPhysician')->with('medicalTechnologist')->with('pathologist')->findOrFail($request->id)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Laboratory/Fecalysis/EditFecalysis', [
            'data' => new FecalysisResource(FecalysisRecord::join('fecalysis','fecalysis.id','=','fecalysis_records.id')->findOrFail($request->id)),
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getAllOrNos(),
            'requests' => $this->getRequests(),
        ]);
    }

    /**
     * Get all the client infirmary id and name who has paid for fecalysis service but hasn't been used in fecalysis records
     */
    private function getClients()
    {
        // get all clients
        return new ClientCollection(LaboratoryRequest::join('clients','clients.infirmary_id','laboratory_requests.infirmary_id')
            ->where('laboratory_requests.stool_exam', 1)
            ->selectRaw("clients.infirmary_id AS id, laboratory_requests.id as rqst_id, CONCAT(first_name, ' ', last_name) AS name")->get());
//        Get all client who paid for fecalysis service but hasn't been used in fecalysis records
//        return new ClientCollection(Client::join('payments', 'payments.infirmary_id', '=', 'clients.infirmary_id')
//            ->join('payments_service', 'payments_service.payment_id', '=', 'payments.id')
//            ->leftJoin('fecalysis_records', function ($join) {
//                $join->on('fecalysis_records.or_no', '=', 'payments_service.payment_id')
//                    ->whereNull('fecalysis_records.or_no');
//            })
//            ->where('payments_service.service_id', 2)
//            ->selectRaw("clients.infirmary_id AS id, CONCAT(clients.infirmary_id, ' - ', clients.first_name, ' ', clients.last_name) AS name")
//            ->groupBy('clients.infirmary_id')
//            ->get());
    }

    /**
     * Get all the or_no that is for fecalysis service and hasn't been used in fecalysis records
     */
    public function getUnsedOrNos()
    {
        return new PaymentCollection(Payment::join('payments_service', 'payments_service.payment_id', '=', 'payments.or_no')
            ->join('services', 'services.id', '=', 'payments_service.service_id')
            ->where('services.room_no', '=', 'Room-3')
            ->whereNotIn('payments.or_no', FecalysisRecord::select('or_no')->get())
            ->selectRaw('payments.or_no as id, CONCAT(payments.or_no) as name')
            ->orderBy('payments.or_no', 'asc')
            ->get());
    }

    public function getAllOrNos()
    {
        return new PaymentCollection(Payment::join('payments_service', 'payments_service.payment_id', '=', 'payments.or_no')
            ->join('services', 'services.id', '=', 'payments_service.service_id')
            ->where('services.room_no', '=', 'Room-3')
            ->selectRaw('payments.or_no as id, CONCAT(payments.or_no) as name')
            ->orderBy('payments.or_no', 'asc')
            ->get());
    }

    /**
     * Get all the physicians
     */
    public function getPhysicians()
    {
        return new UserCollection(User::selectRaw('id, CONCAT(first_name, " ", last_name) as name')->where('role',2)->get());
    }

    /**
     * Get all the requests
     */
    public function getRequests()
    {
        return new LaboratoryCollection(LaboratoryRequest::join('clients', 'clients.infirmary_id', 'laboratory_requests.infirmary_id')
            ->where('laboratory_requests.stool_exam', 1)
            ->where('laboratory_requests.status', 'pending')
            ->selectRaw('clients.infirmary_id as id,laboratory_requests.id as rqst_id, CONCAT(CONCAT(clients.infirmary_id, " ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(CONCAT(" ",clients.suffix), "")) ) as name, clients.age, clients.sex, clients.infirmary_id')
            ->get());
    }
}
