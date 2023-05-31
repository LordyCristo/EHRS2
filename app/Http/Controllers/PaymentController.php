<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\FeeCollection;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\ServiceCollection;
use App\Models\Client;
use App\Models\Fees;
use App\Models\Payment;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Finance/Payment/PaymentIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Finance/Payment/NewPayment', [
            'clients' => new ClientCollection(Client::selectRaw("id, CONCAT(id, ' - ',first_name, IF(middle_name IS NOT NULL, CONCAT(' ', middle_name), ''),' ', last_name, IF(suffix IS NOT NULL, CONCAT(' ', suffix), '')) as name")->get()),
            //'services' => new ServiceCollection(Services::select('id', 'name')->get()),
            'last_payment_id' => (int) Payment::select('or_no')->orderBy('or_no', 'desc')->value('or_no'),
            'services' => new FeeCollection(Fees::join('services','services.id','=','fees.service_id')
                ->selectRaw("fees.id as id, services.name as name, fees.amount as fee")->orderBy('fees.id','asc')->get()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $lastPayment = Payment::withTrashed()->select('id')->orderBy('id', 'desc')->first();
        $lastPaymentOrNo = $lastPayment?->or_no;
        return Inertia::render('Finance/Payment/EditPayment', [
            'data' => new PaymentResource(Payment::with('paidServices')->findOrFail($request->id)),
            'clients' => new ClientCollection(Client::selectRaw("id, CONCAT(id, ' - ',first_name, IF(middle_name IS NOT NULL, CONCAT(' ', middle_name), ''),' ', last_name, IF(suffix IS NOT NULL, CONCAT(' ', suffix), '')) as name")->get()),
            'services' => new FeeCollection(Fees::join('services','services.id','=','fees.service_id')
                ->selectRaw("fees.id as id, services.name as name, fees.amount as fee")->orderBy('fees.id','asc')->get()),
            'last_payment_id' => new PaymentResource($lastPaymentOrNo),
        ]);
    }

    /**
     * Show a resource.
     */
    public function show(Request $request)
    {
        return Inertia::render('Finance/Payment/ViewPayment', [
            'data' => new PaymentResource(Payment::with('paidServices')->with('client')->findOrFail($request->id)),
        ]);
    }
}
