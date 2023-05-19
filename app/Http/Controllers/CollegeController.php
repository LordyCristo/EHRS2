<?php

namespace App\Http\Controllers;

use App\Models\College;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = College::select(['id', 'name', 'abbr', 'is_active']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('id', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('abbr', 'like', '%' . $search . '%')
                        ->orWhere('is_active', 'like', '%' . $search . '%');
                } else {
                    $q->where('colleges.' . $searchBy, 'like', '%' . $search . '%');
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
            //get the total number of pages
            'totalPages' => $paginator->lastPage(),
            'hasMorePage' => $paginator->hasMorePages(),
            'totalCount' => $paginator->total(),
            'data' => $paginator->items(),
            'perPage' => $paginator->perPage(),
            'pageCount' => $paginator->perPage(),
            'prevPage' => $paginator->lastPage(),
            'currPage' => $paginator->currentPage(),
            'nextPage' => $paginator->nextPageUrl(),
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
        $errors = $validator->errors();
        if ($errors->any()) {
            $errorMessages = [];
            foreach ($errors->keys() as $key) {
                $errorMessages[$key] = $errors->get($key)[0];
            }
            return inertia('MorePages/Colleges/NewCollege', [
                'type' => 'failed',
                'message' => 'College not added',
                'errors' => $errorMessages,
            ]);
        }
        College::create($request->all());
        return inertia('MorePages/Colleges/CollegeIndex', [
            'notifType' => 'success',
            'notifMessage' => 'New College added successfully'
        ]);
    }

    function rules(){
        return [
            'name' => 'required|unique:colleges|max:255',
            'abbr' => 'required|unique:colleges|max:255',
            'is_active' => 'required|boolean',
        ];
    }

    function messages(){
        return [
            'name.required' => 'Required field',
            'name.unique' => 'Already exists',
            'name.max' => 'Too long',
            'abbr.required' => 'Required field',
            'abbr.unique' => 'Already exists',
            'abbr.max' => 'Too long',
            'is_active.required' => 'Required field',
            'is_active.boolean' => 'Invalid value',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $temp = College::destroy($id);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        if ($temp) {
            return inertia('MorePages/Colleges/CollegeIndex', [
                'status' => 'success',
                'message' => 'Records deleted successfully',
                'data' => $temp,
            ]);
        }
        return inertia('MorePages/Colleges/CollegeIndex', [
            'status' => 'failed',
            'message' => 'Unable to delete record',
        ]);
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
                    College::create($d);
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
     * Get all data from the colleges table
     */
    public function getAll(){
        return response()->json(College::select('*')->get());
    }
}
