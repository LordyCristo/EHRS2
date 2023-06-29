<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Http\Resources\XrayCollection;
use App\Http\Resources\XrayResource;
use App\Models\Client;
use App\Models\FecalysisRecord;
use App\Models\PaymentsService;
use App\Models\Services;
use App\Models\User;
use App\Models\XrayRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RadiologyResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Radiology/Result/RadiologyIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Radiology/Result/NewRadiology',[
            'physicians' => $this->getPhysicians(),
            // only return xray requests that don't have results yet
            'xray_reqs' => $this->getXrayReq(),
            'xray_procedures' => $this->getXrayProcedures(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return Inertia::render('Radiology/Result/ViewRadiology',[
            'data' => new XrayResource(XrayRequest::with('xray')->with('client')->with('rqstPhysician')->findOrFail($request->id)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Radiology/Result/EditRadiology',[
            'data' => new XrayResource(XrayRequest::with('xray')->findOrFail($request->id)),
            'physicians' => $this->getPhysicians(),
            // when updating, all xray request should be returned to the list of xray requests
            'xray_reqs' => new XrayResource(XrayRequest::join('clients', 'clients.infirmary_id', '=', 'xray_requests.infirmary_id')
                ->leftJoin('xrays', 'xrays.rqst_id', '=', 'xray_requests.id')
                ->selectRaw('xray_requests.id as id, CONCAT(clients.infirmary_id, " - ", CONCAT(clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(clients.suffix, "")) ) as name, clients.age, clients.sex')
                ->get()),
            'xray_procedures' => $this->getXrayProcedures(),
        ]);
    }

    /**
     * Get all the client infirmary id and name who has paid for hematology service but hasn't been used in hematology records
     */
    private function getClients()
    {
        return new ClientCollection(Client::join('payments', 'payments.infirmary_id', '=', 'clients.infirmary_id')
            ->join('payments_service', 'payments_service.payment_id', '=', 'payments.id')
            ->leftJoin('hematology_records', function ($join) {
                $join->on('hematology_records.or_no', '=', 'payments_service.payment_id')
                    ->whereNull('hematology_records.or_no');
            })
            ->where('payments_service.service_id', 5)
            ->selectRaw("clients.infirmary_id AS id, CONCAT(clients.infirmary_id, ' - ', clients.first_name, ' ', clients.last_name) AS name")
            ->groupBy('clients.infirmary_id')
            ->get());
    }

    /**
     * Get all the or_no that is for hematology service and hasn't been used in hematology records
     */
    public function getOrNos()
    {
        $selectedXrayId = request()->id;
        $selectedXrayInfirmaryId = XrayRequest::where('id', $selectedXrayId)->value('infirmary_id');

        return new PaymentCollection(PaymentsService::select('payments_service.payment_id AS id', 'payments_service.payment_id AS name')
            ->leftJoin('hematology_records', function ($join) use ($selectedXrayId, $selectedXrayInfirmaryId) {
                $join->on('hematology_records.or_no', '=', 'payments_service.payment_id')
                    ->where(function ($query) use ($selectedXrayId, $selectedXrayInfirmaryId) {
                        $query->whereNull('hematology_records.or_no')
                            ->orWhere('hematology_records.id', $selectedXrayId)
                            ->orWhere('hematology_records.infirmary_id', $selectedXrayInfirmaryId);
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

    /**
     * Get all Xray services
     */
    public function getXrayProcedures()
    {
        // only return xray services that are in room 2
        return new XrayCollection(Services::selectRaw("id, CONCAT(id,' ',name) as name")->where('room_no','=','Room-2')->get());
    }

    /**
     * Get all x-ray requests
     */
    public function getXrayReq()
    {
        return new XrayResource(XrayRequest::join('clients', 'clients.infirmary_id', '=', 'xray_requests.infirmary_id')
            ->leftJoin('xrays', 'xrays.rqst_id', '=', 'xray_requests.id')
            ->whereNull('xrays.id')
            ->selectRaw('xray_requests.id as id, CONCAT(CONCAT(clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(CONCAT(" ",clients.suffix), "")) ) as name, clients.age, clients.sex, clients.infirmary_id')
            ->orderBy('xray_requests.created_at', 'asc')
            ->get());
    }
}
