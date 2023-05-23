<?php

namespace App\Http\Controllers;

use App\Http\Resources\DegreeProgramCollection;
use App\Models\Client;
use App\Models\ClientType;
use App\Models\DegreeProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Client/ClientIndex',);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Client/NewClient', $this->getFlags());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $temp = $this->getFlags();
        return Inertia::render('Client/EditClient', [
            'data' => Client::findOrFail($request->id),
            'degree_programs' => $temp['degree_programs'],
            'client_types' => $temp['client_types'],
            'last_client_id' => $temp['last_client_id'],
        ]);
    }

    private function getFlags(): array
    {
        return [
            'degree_programs' => DegreeProgram::select(['id', DB::raw("CONCAT(`name`, IFNULL(CONCAT(' major in ', `major`), '')) AS `name`")])->orderBy('id', 'asc')->get(),
            'client_types' => ClientType::select(['id', 'name'])->orderBy('id', 'asc')->get(),
            'last_client_id' => Client::select('id')->orderBy('id', 'desc')->first()->id ?? '0',
        ];
    }
}
