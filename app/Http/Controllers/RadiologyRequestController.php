<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Http\Resources\XrayRequestResource;
use App\Http\Resources\XrayResource;
use App\Models\Client;
use App\Models\FecalysisRecord;
use App\Models\PaymentsService;
use App\Models\User;
use App\Models\XrayRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RadiologyRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Radiology/Request/RadiologyRequestIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Radiology/Request/NewRadiologyRequest',[
            'physicians' => $this->getPhysicians(),
            'clients' => $this->getClients(),
            'or_nos' => $this->getOrNos(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('Radiology/Request/ViewRadiologyRequest',[
            'data' => new XrayRequestResource(XrayRequest::with('client')->findOrFail($id)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Radiology/Request/EditRadiologyRequest',[
            'data' => new XrayRequestResource(XrayRequest::findOrFail($request->id)),
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
        return new ClientCollection(Client::selectRaw('infirmary_id AS id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""),last_name, IFNULL(CONCAT(" ",suffix), ""))) as name, age, sex')->get());
    }

    /**
     * Get all the or_no that is for hematology service and hasn't been used in hematology records
     */
    public function getOrNos()
    {
        $selectedHematologyId = request()->id;
        $selectedHematologyInfirmaryId = FecalysisRecord::where('id', $selectedHematologyId)->value('infirmary_id');

        return new PaymentCollection(PaymentsService::select('payments_service.payment_id AS id', 'payments_service.payment_id AS name')
            ->leftJoin('hematology_records', function ($join) use ($selectedHematologyId, $selectedHematologyInfirmaryId) {
                $join->on('hematology_records.or_no', '=', 'payments_service.payment_id')
                    ->where(function ($query) use ($selectedHematologyId, $selectedHematologyInfirmaryId) {
                        $query->whereNull('hematology_records.or_no')
                            ->orWhere('hematology_records.id', $selectedHematologyId)
                            ->orWhere('hematology_records.infirmary_id', $selectedHematologyInfirmaryId);
                    });
            })
            ->where('payments_service.service_id', 5)
            ->orderBy('payments_service.payment_id', 'asc')
            ->get());
    }

    /**
     * Get all the physicians
     */
    public function getPhysicians()
    {
        return new UserCollection(User::selectRaw('id, CONCAT(first_name, " ", last_name) as name')->where('role',2)->get());
    }
}
