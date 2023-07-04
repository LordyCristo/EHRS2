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

    public function ask()
    {
        return Inertia::render('PhysicalExam/AskPhysicalExam');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function student()
    {
        return Inertia::render('PhysicalExam/NewPhysicalExam',[
            'physicians' => new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->get()),
            'clients' => new ClientCollection(Client::selectRaw('infirmary_id as id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name, sex, civil_status, age, birthdate')->get()),
        ]);
    }

    public function outpatient()
    {
        return Inertia::render('PhysicalExam/PhysicalExamOutpatient',[
            'physicians' => new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->get()),
            'clients' => new ClientCollection(Client::selectRaw('clients.*, infirmary_id as id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->get()),
        ]);
    }

    public function er()
    {

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
            'data' => new PhysicalExamResource(PhysicalExam::with('attachments')->findOrFail($request->id)),
            'physicians' => new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->where('role',2)->get()),
            'clients' => new ClientCollection(Client::selectRaw('infirmary_id as id, CONCAT(CONCAT(clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(CONCAT(" ",clients.suffix), ""))) as name, sex, civil_status, age, birthdate')->get()),
        ]);
    }

}
