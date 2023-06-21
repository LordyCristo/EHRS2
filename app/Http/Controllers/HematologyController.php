<?php

namespace App\Http\Controllers;

use App\Http\Requests\HematologyRequest;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\HematologyCollection;
use App\Http\Resources\HematologyRecordCollection;
use App\Http\Resources\HematologyRecordResource;
use App\Http\Resources\HematologyResource;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Models\Client;
use App\Models\FecalysisRecord;
use App\Models\Hematology;
use App\Models\HematologyRecord;
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
            'or_nos' => $this->getOrNos(),
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
            'or_nos' => $this->getOrNos(),
        ]);
    }

    /**
     * Get all the client infirmary id and name who has paid for hematology service but hasn't been used in hematology records
     */
    private function getClients()
    {
        // get all clients
        return new ClientCollection(Client::selectRaw("infirmary_id AS id, CONCAT(infirmary_id, ' - ', first_name, ' ', last_name) AS name")->get());

//        return new ClientCollection(Client::join('payments', 'payments.infirmary_id', '=', 'clients.infirmary_id')
//            ->join('payments_service', 'payments_service.payment_id', '=', 'payments.id')
//            ->leftJoin('hematology_records', function ($join) {
//                $join->on('hematology_records.or_no', '=', 'payments_service.payment_id')
//                    ->whereNull('hematology_records.or_no');
//            })
//            ->where('payments_service.service_id', 3)
//            ->selectRaw("clients.infirmary_id AS id, CONCAT(clients.infirmary_id, ' - ', clients.first_name, ' ', clients.last_name) AS name")
//            ->groupBy('clients.infirmary_id')
//            ->get());
    }

    /**
     * Get all the or_no that is for hematology service and hasn't been used in hematology records
     */
    public function getOrNos()
    {
        return new PaymentCollection(
            PaymentsService::selectRaw("payments.or_no AS id, CONCAT(payments.or_no, ' - ', clients.first_name, ' ', clients.last_name) AS name")
                ->join('payments', 'payments.id', '=', 'payments_service.payment_id')
                ->join('clients', 'clients.infirmary_id', '=', 'payments.infirmary_id')
                ->leftJoin('hematology_records', 'hematology_records.or_no', '=', 'payments.or_no')
                ->where('payments_service.service_id', 128)  //128 is the id for hematology/CBC service\
                ->whereNull('hematology_records.or_no') // Filter out used or_no in hematology_records
                ->groupBy('payments.or_no')
                ->get()
        );
    }

    /**
     * Get all the physicians
     */
    public function getPhysicians()
    {
        return new UserCollection(User::selectRaw('id, CONCAT(first_name, " ", last_name) as name')->where('role',1)->get());
    }
}
