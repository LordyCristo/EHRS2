<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\DataCollection;
use App\Http\Resources\DentalResource;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Models\Client;
use App\Models\DentalCertificate;
use App\Models\DentalRecord;
use App\Models\DentalTreatment;
use App\Models\Payment;
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
            'data' => new DentalResource(DentalRecord::with(['client','dentist'])->findOrFail($request->id)),
            'dentists' => $this->getPhysicians(),
            'or_nos' => $this->getOrNos(),
        ]);
    }

    public function printable(Request $request)
    {
        return Inertia::render('Dentistry/DentalRecord/DentalCertificatePrintable',[
            'data' => new DentalResource(DentalCertificate::with(['client','dentist','payment'])->findOrFail($request->id)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Dentistry/DentalRecord/EditDentalRecord',[
            'data' => new DentalResource(DentalRecord::join('dentals', 'dental_records.dental_result_id', '=', 'dentals.id')
                ->selectRaw('dental_records.id as dental_record_id, dental_records.*, dentals.*')
                ->findOrFail($request->id)),
            'treatments' => new DataCollection(DentalTreatment::where('dental_record_id','=',$request->id)->get()),
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
        return new ClientCollection(Client::selectRaw('infirmary_id AS id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""),last_name, IFNULL(CONCAT(" ",suffix), ""))) as name, sex, age, birthdate')->orderBy('infirmary_id')->get());
    }

    /**
     * Get all the or_no that is for fecalysis service and hasn't been used in fecalysis records
     */
    public function getOrNos()
    {
        return new PaymentCollection(Payment::join('payments_service', 'payments_service.payment_id', '=', 'payments.or_no')
            ->join('services', 'services.id', '=', 'payments_service.service_id')
            ->where('services.room_no', '=', 'Room-1')
            ->selectRaw('payments.or_no as id, CONCAT(payments.or_no) as name')
            ->orderBy('payments.or_no', 'asc')
            ->get());
    }

    /**
     * Get all the physicians
     */
    public function getPhysicians()
    {
        return new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""),last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->where('role',2)->get());
    }
}
