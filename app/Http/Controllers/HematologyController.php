<?php

namespace App\Http\Controllers;

use App\Http\Requests\HematologyRequest;
use App\Http\Resources\HematologyCollection;
use App\Http\Resources\HematologyRecordCollection;
use App\Http\Resources\HematologyRecordResource;
use App\Http\Resources\HematologyResource;
use App\Http\Resources\UserCollection;
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
            'physicians' => new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get()),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
//        $hematology = new HematologyResource(Hematology::findOrFail($request->id));
//        $record = new HematologyRecordResource(HematologyRecord::findOrFail($request->id));
        return Inertia::render('Laboratory/Hematology/EditHematology',[
            'data' => new HematologyResource(HematologyRecord::join('hematology', 'hematology.id', '=', 'hematology_records.id')->where('hematology.id', '=', $request->id)->get()),
            'physicians' => new UserCollection(User::where('role', '<>', 1)->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name")->get()),
        ]);
    }
}
