<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
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

        if (isset($request['order'][0]['column'])) {
            $order = $request['order'][0]['column'];
            $dir = $request['order'][0]['dir'];
            $query->orderBy($request['columns'][$order]['data'], $dir);
        } else {
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
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = [];
            foreach ($errors->keys() as $key) {
                $errorMessages[$key] = $errors->get($key)[0];
            }
            return inertia('Patient/NewPatient', [
                'errors' => $errorMessages,
            ]);
        }
        Client::create($request->all());
        return inertia('Patient/PatientDashboard', [
            'success' => 'Patient added successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $temp = Client::find($id);
        if ($temp) {
            return $temp;
        } else {
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
        if ($destroyed_id) {
            return inertia('Patient/PatientsDashboard', compact('destroyed_id'));
        } else {
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
    function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'age' => 'nullable|int',
            'sex' => 'required|in:`male`,`female`',
            'civil_status' => 'required|in:`single`,`married`,`widowed`,`separated`,`divorced`',
            'phone' => 'nullable|string|max:255|unique:clients,phone|starts_with:09|size:11',
            'email_address' => 'nullable|email|max:255|unique:clients,email_address',
            'home_address' => 'nullable|string|max:255',
            'curr_address' => 'nullable|string|max:255',
            'id_number' => 'nullable|string|max:255|unique:clients,id_number|regex:/^[0-9]{2}-[0-9]{1}-[0-9]{5}$/',
            'program_id' => 'nullable|exists:degree_programs,id',
            'year_lvl' => 'nullable|int',
            'client_type_id' => 'required|exists:client_types,id',
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
            'first_name.required' => 'Required field',
            'first_name.string' => 'Invalid input',
            'first_name.max' => 'Too long',
            'middle_name.string' => 'Invalid input',
            'middle_name.max' => 'Too long',
            'last_name.required' => 'Required field',
            'last_name.string' => 'Invalid input',
            'last_name.max' => 'Too long',
            'suffix.string' => 'Invalid input',
            'suffix.max' => 'Too long',
            'birthdate.required' => 'Required field',
            'birthdate.date' => 'Invalid date',
            'age.int' => 'Invalid input',
            'sex.required' => 'Required field',
            'sex.in' => 'Invalid value',
            'civil_status.required' => 'Required field',
            'civil_status.in' => 'Invalid value',
            'phone.string' => 'Invalid input',
            'phone.max' => 'Too long',
            'phone.unique' => 'Already exists',
            'phone.starts_with' => 'Invalid format',
            'phone.size' => 'Too long',
            'email_address.email' => 'Invalid email address',
            'email_address.max' => 'Too long',
            'email_address.unique' => 'Already exists',
            'home_address.string' => 'Invalid input',
            'home_address.max' => 'Too long',
            'curr_address.string' => 'Invalid input',
            'curr_address.max' => 'Too long',
            'id_number.string' => 'Invalid input',
            'id_number.max' => 'Too long',
            'id_number.unique' => 'Already exists',
            'id_number.regex' => 'Invalid format',
            'program_id.exists' => 'Invalid input',
            'year_lvl.int' => 'Invalid input',
            'client_type_id.required' => 'Required field',
            'client_type_id.exists' => 'Invalid input',
        ];
    }
}
