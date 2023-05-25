<?php

namespace App\Http\Controllers;

use App\Http\Requests\HematologyRequest;
use App\Models\Hematology;
use App\Models\HematologyRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HematologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Laboratory/Hematology/HematologyIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Laboratory/Hematology/NewHematology', [
            'physicians' => User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get(),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HematologyRequest $request)
    {
        $hematology = Hematology::findOrFail($request->id);
        $record = HematologyRecord::findOrFail($request->id);

        return Inertia::render('Laboratory/Hematology/EditHematology');
    }
}
