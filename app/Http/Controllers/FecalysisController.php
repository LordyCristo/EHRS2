<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Http\Resources\fecalysisCollection;
use App\Http\Resources\fecalysisResource;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Models\Fecalysis;
use App\Models\FecalysisRecord;
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
            'or_nos' => $this->getOrNos(),
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
            'or_nos' => $this->getOrNos(),
        ]);
    }

    /**
     * Get all the client infirmary id and name who has paid for fecalysis service but hasn't been used in fecalysis records
     */
    private function getClients()
    {
        return new ClientCollection(Client::join('payments', 'payments.infirmary_id', '=', 'clients.infirmary_id')
            ->join('payments_service', 'payments_service.payment_id', '=', 'payments.id')
            ->leftJoin('fecalysis_records', function ($join) {
                $join->on('fecalysis_records.or_no', '=', 'payments_service.payment_id')
                    ->whereNull('fecalysis_records.or_no');
            })
            ->where('payments_service.service_id', 2)
            ->selectRaw("clients.infirmary_id AS id, CONCAT(clients.infirmary_id, ' - ', clients.first_name, ' ', clients.last_name) AS name")
            ->groupBy('clients.infirmary_id')
            ->get());
    }

    /**
     * Get all the or_no that is for fecalysis service and hasn't been used in fecalysis records
     */
    public function getOrNos()
    {
        $selectedFecalysisId = request()->id;
        $selectedFecalysisInfirmaryId = FecalysisRecord::where('id', $selectedFecalysisId)->value('infirmary_id');

        return new PaymentCollection(PaymentsService::select('payments_service.payment_id AS id', 'payments_service.payment_id AS name')
            ->leftJoin('fecalysis_records', function ($join) use ($selectedFecalysisId, $selectedFecalysisInfirmaryId) {
                $join->on('fecalysis_records.or_no', '=', 'payments_service.payment_id')
                    ->where(function ($query) use ($selectedFecalysisId, $selectedFecalysisInfirmaryId) {
                        $query->whereNull('fecalysis_records.or_no')
                            ->orWhere('fecalysis_records.id', $selectedFecalysisId)
                            ->orWhere('fecalysis_records.infirmary_id', $selectedFecalysisInfirmaryId);
                    });
            })
            ->where('payments_service.service_id', 2)
            ->orderBy('payments_service.payment_id', 'asc')
            ->get());
    }

    public function editq(Request $request)
    {
        return Inertia::render('Laboratory/Fecalysis/EditFecalysis', [
            'data' => new FecalysisResource(FecalysisRecord::join('fecalysis','fecalysis.id','=','fecalysis_records.id')->findOrFail($request->id)),
            'physicians' => new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get()),
            'clients' => new ClientCollection(Payment::join('clients','clients.infirmary_id','=','payments.infirmary_id')->selectRaw("clients.infirmary_id AS id, CONCAT(clients.infirmary_id, ' - ', clients.first_name, ' ', clients.last_name) AS name")->groupBy('clients.infirmary_id')->get()),
            'or_nos' => new PaymentCollection(Payment::selectRaw("or_no AS id, or_no AS name")->orderBy('or_no','asc')->get()),
        ]);
    }

    /**
     * Get all the physicians
     */
    public function getPhysicians()
    {
        return new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get());
    }
}
