<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\PhysicalExamResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Client;
use App\Models\PhysicalExam;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PhysicalExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('PhysicalExam/PhysicalExamIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('PhysicalExam/NewPhysicalExam',[
            'physicians' => new UserCollection(User::selectRaw('id, CONCAT(first_name, " ", last_name) as name')->get()),
            'clients' => new ClientCollection(Client::selectRaw('infirmary_id as id, CONCAT(first_name, " ", last_name) as name, sex, civil_status, age, birthdate')->get()),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PhysicalExam $physicalExam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return Inertia::render('PhysicalExam/EditPhysicalExam', [
            'data' => new PhysicalExamResource(PhysicalExam::findOrFail($request->id)),
            'physicians' => new UserCollection(User::selectRaw('id, CONCAT(first_name, " ", last_name) as name')->where('role',1)->get()),
            'clients' => new ClientCollection(Client::selectRaw('infirmary_id as id, CONCAT(first_name, " ", last_name) as name, sex, civil_status, age, birthdate')->get()),
        ]);
    }

}
