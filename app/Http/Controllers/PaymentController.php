<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\FeeCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Client;
use App\Models\Fees;
use App\Models\Payment;
use Illuminate\Http\Request;
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
            'clients' => $this->getClients(),
            'last_payment_id' => $this->getLastPaymentId(),
            'services' => $this->getServices(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        return Inertia::render('Finance/Payment/EditPayment', [
            'data' => new PaymentResource(Payment::with('paidServices')->findOrFail($request->id)),
            'clients' => $this.getClients(),
            'services' => $this.getServices(),
            'last_payment_id' => $this->getLastPaymentId(),
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

    private function getClients(){
        return new ClientCollection(Client::selectRaw("infirmary_id as id, CONCAT(first_name, IF(middle_name IS NOT NULL, CONCAT(' ', middle_name), ''),' ', last_name, IF(suffix IS NOT NULL, CONCAT(' ', suffix), '')) as name, CONCAT(first_name, IF(middle_name IS NOT NULL, CONCAT(' ', middle_name), ''),' ', last_name, IF(suffix IS NOT NULL, CONCAT(' ', suffix), '')) as fullname, email_address, phone")->get());
    }

    private function getServices(){
        return new FeeCollection(Fees::join('services', 'services.id', '=', 'fees.service_id')
            ->join('client_types', 'client_types.id', '=', 'fees.client_type')
            ->selectRaw("fees.id as id, fees.service_id, fees.amount as fee, CONCAT(services.name, ' (',client_types.name, ' ', fees.amount,')') as name")->orderBy('fees.id', 'asc')->get());
    }

    private function getLastPaymentId(){
        return (int)Payment::select('or_no')->orderBy('or_no', 'desc')->withTrashed()->first()?->or_no;
    }
}
