<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\ServiceCollection;
use App\Models\Client;
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
            'services' => new ServiceCollection(Services::select('id', 'name')->get()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Finance/Payment/EditPayment', [
            'data' => new PaymentResource(Payment::findOrFail($request->id)),
            'clients' => new ClientCollection(Client::selectRaw("id, CONCAT(id, ' - ',first_name, IF(middle_name IS NOT NULL, CONCAT(' ', middle_name), ''),' ', last_name, IF(suffix IS NOT NULL, CONCAT(' ', suffix), '')) as name")->get()),
            'services' => new ServiceCollection(Services::select('id', 'name')->get()),
            'last_payment_id' => Payment::select('id')->orderBy('id', 'desc')->first()->id,
        ]);
    }

    /**
     * Show a resource.
     */
    public function show(Request $request)
    {
        return Inertia::render('Finance/Payment/ViewPayment', [
//            'data' => new PaymentResource(Payment::join('clients', 'clients.id', '=', 'payments.client_id')
//                ->selectRaw('payments.*, clients.id as client_id, CONCAT(clients.first_name, IF(clients.middle_name IS NOT NULL, CONCAT(" ", clients.middle_name), ""), " ", clients.last_name, IF(clients.suffix IS NOT NULL, CONCAT(" ", clients.suffix), "")) as client_name')
//                ->with('services')
//                ->findOrFail($request->id)),
        'data' => new PaymentResource(Payment::with('service')->findOrFail($request->id)),
        ]);
    }
}
