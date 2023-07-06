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
        return Inertia::render('PhysicalExam/NewPhysicalExamOutpatient',[
            'physicians' => new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->get()),
            'clients' => new ClientCollection(Client::selectRaw('clients.*, infirmary_id as id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->get()),
        ]);
    }

    public function er()
    {
        return Inertia::render('PhysicalExam/NewPhysicalExamER',[
            'physicians' => new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->get()),
            'clients' => new ClientCollection(Client::selectRaw('clients.*, infirmary_id as id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->get()),
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
        $record = new PhysicalExamResource(PhysicalExam::with('attachments')->findOrFail($request->id));
        if ($record->form_type === 'student')
            return Inertia::render('PhysicalExam/EditPhysicalExam', [
                'data' => $record,
                'physicians' => new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->where('role',2)->get()),
                'clients' => new ClientCollection(Client::selectRaw('infirmary_id as id, CONCAT(CONCAT(clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(CONCAT(" ",clients.suffix), ""))) as name, sex, civil_status, age, birthdate, religion, client_type_id')->get()),
            ]);
        else if ($record->form_type === 'outpatient')
            return Inertia::render('PhysicalExam/EditPhysicalExamOutpatient', [
                'data' => $record,
                'physicians' => new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->where('role',2)->get()),
                'clients' => new ClientCollection(Client::selectRaw('infirmary_id as id, CONCAT(CONCAT(clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(CONCAT(" ",clients.suffix), ""))) as name, sex, civil_status, age, birthdate, religion, client_type_id')->get()),
            ]);
        else
            return Inertia::render('PhysicalExam/EditPhysicalExamER', [
                'data' => $record,
                'physicians' => new UserCollection(User::selectRaw('id, CONCAT(CONCAT(first_name, IFNULL(CONCAT(" ",middle_name, " "), ""), last_name, IFNULL(CONCAT(" ",suffix), ""))) as name')->where('role',2)->get()),
                'clients' => new ClientCollection(Client::selectRaw('infirmary_id as id, CONCAT(CONCAT(clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), clients.last_name, IFNULL(CONCAT(" ",clients.suffix), ""))) as name, sex, civil_status, age, birthdate, religion, client_type_id')->get()),
             ]);
    }

}
