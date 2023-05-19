<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\ClientType;
use App\Models\DegreeProgram;
use Exception;
use Illuminate\Contracts\Validation\Rule;
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
        $query = Client::select(['clients.*', 'client_types.name as client_type_id'])
            ->leftJoin('client_types', 'client_types.id', '=', 'clients.client_type_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('first_name', 'like', '%' . $search . '%')
                      ->orWhere('last_name', 'like', '%' . $search . '%')
                      ->orWhere('middle_name', 'like', '%' . $search . '%')
                      ->orWhere('suffix', 'like', '%' . $search . '%')
                      ->orWhere('age', 'like', '%' . $search . '%')
                      ->orWhere('sex', 'like', '%' . $search . '%')
                      ->orWhere('civil_status', 'like', '%' . $search . '%');
                } else {
                    $q->where('clients.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('sort_dir', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $paginator->items(),
            'totalCount' => $paginator->total(),
            'totalPages' => $paginator->lastPage(),
            'perPage' => $paginator->perPage(),
        ]);
    }

    // export to csv
    public function getAll(){
        return response()->json(Client::all());
    }

    public function import(Request $request){
        $data = $request->all();
        $numFailed = 0; // Initialize a counter for failed insertions
        $erros = []; // Initialize an array to store errors
        foreach ($data as $d){
            try {
                //validate each row of data
                $validator = Validator::make($d, $this->rules(), $this->messages());
                if($validator->fails()){
                    $numFailed++;
                    $errors = $validator->errors();
                    $errorMessages = [];
                    foreach ($errors->keys() as $key) {
                        $errorMessages[$key] = $errors->get($key)[0];
                    }
                    $d['errors'] = $errorMessages;
                    $erros[] = $d;
                }
                else
                    Client::create($d);
            } catch (Exception $e) {
                $numFailed++;
                throw $e;
            }
        }
        return response()->json([
            'numSuccess' => count($data) - $numFailed,
            'numFailed' => $numFailed,
            'data' => $data,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Patient/NewPatient',[
            'degree_programs' => DegreeProgram::select(['id', DB::raw("CONCAT(`name`, IFNULL(CONCAT(' major in ', `major`), '')) AS `name`")])->orderBy('id', 'asc')->get(),
            'client_types' => ClientType::select(['id', 'name'])->orderBy('id', 'asc')->get(),
            'last_client_id' => Client::select('id')->orderBy('id', 'desc')->first()->id ?? '0',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        $errors = $validator->errors();
        if ($errors->any()) {
            $errorMessages = [];
            foreach ($errors->keys() as $key) {
                $errorMessages[$key] = $errors->get($key)[0];
            }
            return inertia('Patient/NewPatient', [
                'type' => 'failed',
                'message' => 'Client not added',
                'errors' => $errorMessages,
                'degree_programs' => DegreeProgram::select(['id', DB::raw("CONCAT(`name`, IFNULL(CONCAT(' major in ', `major`), '')) AS `name`")])->orderBy('id', 'asc')->get(),
                'client_types' => ClientType::select(['id', 'name'])->orderBy('id', 'asc')->get(),
                'last_client_id' => Client::select('id')->orderBy('id', 'desc')->first()->id ?? '0',
            ]);
        }
        Client::create($request->all());
        return inertia('Patient/PatientDashboard', [
            'notifType' => 'success',
            'notifMessage' => 'New Patient added successfully'
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
        return inertia('Patient/EditPatient', [
            'data' => Client::find($id),
            'degree_programs' => DegreeProgram::select(['id', DB::raw("CONCAT(`name`, IFNULL(CONCAT(' major in ', `major`), '')) AS `name`")])->orderBy('id', 'asc')->get(),
            'client_types' => ClientType::select(['id', 'name'])->orderBy('id', 'asc')->get(),
            'last_client_id' => Client::select('id')->orderBy('id', 'desc')->first()->id ?? '0',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = [];
            foreach ($errors->keys() as $key) {
                $errorMessages[$key] = $errors->get($key)[0];
            }
            return inertia('Patient/EditPatient', [
                'errors' => $errorMessages,
                'data' => Client::find($id),
                'degree_programs' => DegreeProgram::select(['id', DB::raw("CONCAT(`name`, IFNULL(CONCAT(' major in ', `major`), '')) AS `name`")])->orderBy('id', 'asc')->get(),
                'client_types' => ClientType::select(['id', 'name'])->orderBy('id', 'asc')->get(),
                'last_client_id' => Client::select('id')->orderBy('id', 'desc')->first()->id ?? '0',
            ]);
        }
        $temp = Client::find($id);
        if ($temp) {
            $temp->update($request->all());
            return inertia('Patient/PatientDashboard', [
                'success' => 'Patient updated successfully'
            ]);
        } else {
            return response()->json([
                'error' => 'Patient not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //$temp = DB::table(Client::getTableName())->where('id', $id)->delete();
        $temp = Client::find($id)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        if ($temp) {
            return inertia('Patient/PatientsDashboard', [
                'status' => 'success',
                'message' => 'Records deleted successfully',
                'data' => $temp,
            ]);
        }
        return inertia('Patient/PatientsDashboard', [
            'status' => 'failed',
            'message' => 'Unable to delete record',
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'age' => 'required|int',
            'sex' => 'required',
            'civil_status' => 'required',
            'phone' => 'required|string|max:255|unique:clients,phone',
            // 'phone => 'required|string|max:255|unique:clients,phone|starts_with:09|size:11'
            'email_address' => 'nullable|email|max:255|unique:clients,email_address',
            'home_address' => 'required|string|max:255',
            'curr_address' => 'required|string|max:255',
            'id_number' => 'nullable|string|max:255|unique:clients,id_number|regex:/^[0-9]{2}-[0-9]{1}-[0-9]{5}$/',
            'program_id' => 'nullable|exists:degree_programs,id',
            'year_lvl' => 'nullable',
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
            'age.required' => 'Required field',
            'sex.required' => 'Required field',
            'sex.in' => 'Invalid value',
            'civil_status.required' => 'Required field',
            'civil_status.in' => 'Invalid value',
            'phone.string' => 'Invalid input',
            'phone.max' => 'Too long',
            'phone.unique' => 'Already exists',
            'phone.required' => 'Required field',
            'phone.starts_with' => 'Invalid format',
            'phone.size' => 'Too long',
            'email_address.email' => 'Invalid email address',
            'email_address.max' => 'Too long',
            'email_address.unique' => 'Already exists',
            'home_address.string' => 'Invalid input',
            'home_address.max' => 'Too long',
            'home_address.required' => 'Required field',
            'curr_address.string' => 'Invalid input',
            'curr_address.max' => 'Too long',
            'curr_address.required' => 'Required field',
            'id_number.string' => 'Invalid input',
            'id_number.max' => 'Too long',
            'id_number.unique' => 'Already exists',
            'id_number.regex' => 'Invalid format',
            'program_id.exists' => 'Invalid input',
            'client_type_id.required' => 'Required field',
            'client_type_id.exists' => 'Invalid input',
        ];
    }
}
