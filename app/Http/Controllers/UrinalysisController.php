<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\LaboratoryCollection;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UrinalysisResource;
use App\Http\Resources\UserCollection;
use App\Models\Client;
use App\Models\LaboratoryRequest;
use App\Models\Payment;
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
            'requests' => $this->getRequests(),
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
            'data' => new UrinalysisResource(UrinalysisRecord::join('urinalysis', 'urinalysis.id', '=', 'urinalysis_records.id')
                ->selectRaw('urinalysis.*, urinalysis_records.*')
                ->findOrFail($request->id)),
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getOrNos(),
            'requests' => $this->getRequests(),
        ]);
    }

    /**
     * Get all the client infirmary id and name who has paid for urinalysis service but hasn't been used in urinalysis records
     */
    private function getClients()
    {
        // get all clients
        //return new ClientCollection(Client::selectRaw("infirmary_id AS id, CONCAT(infirmary_id, ' - ', first_name, ' ', last_name) AS name")->get());
        return new ClientCollection(LaboratoryRequest::join('clients','clients.infirmary_id','laboratory_requests.infirmary_id')
            ->where('laboratory_requests.urinalysis', 1)
            ->selectRaw("clients.infirmary_id AS id, laboratory_requests.id as rqst_id, CONCAT(clients.infirmary_id, ' - ', first_name, ' ', last_name) AS name")->get());
    }

    /**
     * Get all the or_no that is for urinalysis service and hasn't been used in urinalysis records
     */
    public function getOrNos()
    {
        return new PaymentCollection(Payment::join('payments_service', 'payments_service.payment_id', '=', 'payments.or_no')
            ->join('services', 'services.id', '=', 'payments_service.service_id')
            ->where('services.room_no', '=', 'Room-3')
            ->whereNotIn('payments.or_no', UrinalysisRecord::select('or_no')->get())
            ->selectRaw('payments.or_no as id, CONCAT(payments.or_no) as name')
            ->orderBy('payments.or_no', 'asc')
            ->get());
    }

    /**
     * Get all the physicians
     */
    public function getPhysicians()
    {
        return new UserCollection(User::selectRaw('id, CONCAT(first_name, " ", last_name) as name')->where('role',1)->get());
    }

    /**
     * Get all the requests
     */
    public function getRequests()
    {
        return new LaboratoryCollection(LaboratoryRequest::join('clients', 'clients.infirmary_id', 'laboratory_requests.infirmary_id')
            ->where('laboratory_requests.urinalysis', 1)
            ->where('laboratory_requests.status', 'pending')
            ->selectRaw('clients.infirmary_id as id,laboratory_requests.id as rqst_id, CONCAT(CONCAT(clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(CONCAT(" ",clients.suffix), "")) ) as name, clients.age, clients.sex, clients.infirmary_id')
            ->get());
    }
}
