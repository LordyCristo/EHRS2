<?php

namespace App\Http\Controllers;

use App\Http\Requests\HematologyRequest;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\HematologyCollection;
use App\Http\Resources\HematologyRecordCollection;
use App\Http\Resources\HematologyRecordResource;
use App\Http\Resources\HematologyResource;
use App\Http\Resources\LaboratoryCollection;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Models\Client;
use App\Models\FecalysisRecord;
use App\Models\Hematology;
use App\Models\HematologyRecord;
use App\Models\LaboratoryRequest;
use App\Models\Payment;
use App\Models\PaymentsService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HematologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Laboratory/Hematology/HematologyIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Laboratory/Hematology/NewHematology', [
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getUnsedOrNos(),
            'requests' => $this->getRequests(),
        ]);
    }

    /**
     * Show the view for printing a resource.
     */
    public function show(Request $request){
        return Inertia::render('Laboratory/Hematology/ViewHematology',[
            'data' => new HematologyResource(HematologyRecord::with('hematology')->with('rqstPhysician')->with('medicalTechnologist')->with('pathologist')->findOrFail($request->id)),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Laboratory/Hematology/EditHematology',[
            'data' => new HematologyResource(HematologyRecord::join('hematology', 'hematology.id', '=', 'hematology_records.id')->findOrFail($request->id)),
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getAllOrNos(),
            'requests' => $this->getRequests(),
        ]);
    }

    /**
     * Get all the client infirmary id and name who has paid for hematology service but hasn't been used in hematology records
     */
    private function getClients()
    {
        // get all clients
        return new ClientCollection(LaboratoryRequest::join('clients','clients.infirmary_id','laboratory_requests.infirmary_id')
            ->where('laboratory_requests.cbc', 1)
            ->orWhere('laboratory_requests.platelet_count', 1)
            ->orWhere('laboratory_requests.bleeding_clottting_time', 1)
            ->orWhere('laboratory_requests.hemoglobin', 1)
            ->orWhere('laboratory_requests.hematocrit', 1)
            ->orWhere('laboratory_requests.blood_typing', 1)
            ->orWhere('laboratory_requests.wbc_diff_count', 1)
            ->selectRaw("clients.infirmary_id AS id, laboratory_requests.id as rqst_id, CONCAT(clients.infirmary_id, ' ', first_name, ' ', last_name) AS name")->get());
    }

    /**
     * Get all the or_no that is for hematology service and hasn't been used in hematology records
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
            ->where('laboratory_requests.status', 'pending')
            ->where('laboratory_requests.cbc', 1)
            ->orWhere('laboratory_requests.platelet_count', 1)
            ->orWhere('laboratory_requests.bleeding_clottting_time', 1)
            ->orWhere('laboratory_requests.hemoglobin', 1)
            ->orWhere('laboratory_requests.hematocrit', 1)
            ->orWhere('laboratory_requests.blood_typing', 1)
            ->orWhere('laboratory_requests.wbc_diff_count', 1)
            ->selectRaw('clients.infirmary_id as id,laboratory_requests.id as rqst_id, CONCAT(CONCAT(clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(CONCAT(" ",clients.suffix), "")) ) as name, clients.age, clients.sex, clients.infirmary_id')
            ->get());
    }
}
