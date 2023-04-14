<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class PatientInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');

        $query = Client::select('id', 'first_name', 'middle_name', 'last_name', 'suffix', 'age', 'sex', 'blood_type', 'civil_status', 'degree_program_id', 'year_level');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('middle_name', 'like', '%' . $search . '%')
                    ->orWhere('suffix', 'like', '%' . $search . '%')
                    ->orWhere('age', 'like', '%' . $search . '%')
                    ->orWhere('sex', 'like', '%' . $search . '%')
                    ->orWhere('blood_type', 'like', '%' . $search . '%')
                    ->orWhere('civil_status', 'like', '%' . $search . '%')
                    ->orWhere('degree_program_id', 'like', '%' . $search . '%')
                    ->orWhere('year_level', 'like', '%' . $search . '%');
            });
        }

        if(isset($request['order'][0]['column'])){
            $order = $request['order'][0]['column'];
            $dir = $request['order'][0]['dir'];
            $query->orderBy($request['columns'][$order]['data'], $dir);
        }else{
            $query->orderBy('id', 'desc');
        }

        $total = $query->count();
        $data = $query->skip($start)->take($length)->get();
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Client::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $temp = Client::find($id);
        if ($temp) {
            return $temp;
        }else{
            return response()->json([
                'error' => 'Patient not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
