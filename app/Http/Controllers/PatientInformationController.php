<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        //$query = Client::select('id', 'first_name', 'middle_name', 'last_name', 'suffix', 'age', 'sex', 'civil_status', 'program_id', 'year_lvl','client_type_id');
        $query = Client::select();
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('middle_name', 'like', '%' . $search . '%')
                    ->orWhere('suffix', 'like', '%' . $search . '%')
                    ->orWhere('age', 'like', '%' . $search . '%')
                    ->orWhere('sex', 'like', '%' . $search . '%')
                    ->orWhere('civil_status', 'like', '%' . $search . '%')
                    ->orWhere('client_type_id', 'like', '%' . $search . '%');
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
        Validator::make($request->all(), $this->rules(), $this->messages())->validate();
        DB::beginTransaction();
        try {
            $temp = Client::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return inertia('Patient/NewPatient', [
                'errors' => $e->getMessage(),
            ]);
        }
        return inertia('Patient/PatientsDashboard', compact('temp'));
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
        $destroyed_id = Client::destroy($id);
        if($destroyed_id){
            return inertia('Patient/PatientsDashboard', compact('destroyed_id'));
        }else{
            return inertia('Patient/PatientsDashboard', [
                'errors' => 'Patient not found'
            ]);
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    function rules(){
        return [
            'first_name' => 'required|string|max:255',
            // 'middle_name' => 'nullable|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'suffix' => 'nullable|string|max:255',
            // 'birthdate' => 'required|date',
            // 'age' => 'nullable|int',
            // 'sex' => 'required|in:`male`,`female`',
            // 'phone' => 'nullable|string|max:255',
            // 'email_address' => 'nullable|email|max:255',
            // 'home_address' => 'nullable|string|max:255',
            // 'curr_address' => 'nullable|string|max:255',
            // 'id_number' => 'nullable|string|max:255',
            // 'civil_status' => 'required|in:`single`,`married`,`widowed`,`separated`,`divorced`',
            // 'program_id' => 'nullable|exists:degree_programs,id',
            // 'year_lvl' => 'nullable|int',
            // 'client_type_id' => 'required|exists:client_types,id',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required',
            'first_name.string' => 'First name must be a string',
            'first_name.max' => 'First name must not exceed 255 characters',
        ];
    }
}
