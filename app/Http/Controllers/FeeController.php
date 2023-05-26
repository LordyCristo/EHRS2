<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientTypeCollection;
use App\Http\Resources\FeeResource;
use App\Http\Resources\ServiceCollection;
use App\Models\ClientType;
use App\Models\Fees;
use App\Models\Services;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Finance/Fees/FeeIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Finance/Fees/NewFee', $this->getLegends());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $fee = new FeeResource(Fees::findOrFail($request->id));
        return Inertia::render('Finance/Fees/EditFee', array_merge($this->getLegends(), ['data' => $fee]));
    }

    private function getLegends()
    {
        return array(
            'client_types' => new ClientTypeCollection(ClientType::select('id','name')->get()),
            'services' => new ServiceCollection(Services::select('id','name')->get()),
        );
    }
}
