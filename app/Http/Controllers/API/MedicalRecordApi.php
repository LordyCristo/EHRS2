<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalRecordCollection;
use App\Http\Resources\MedicalRecordResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicalRecordApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new MedicalRecordCollection(Client::withCount('hematology')
            ->withCount('fecalysis')
            ->withCount('urinalysis')
            ->withCount('xray')
            ->withCount('dental')
            ->withCount(['physicalExam' => function ($query) {
                $query->where('form_type', '=', 'student');
            }])
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new MedicalRecordResource(Client::with(['hematology' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }])
        ->with(['fecalysis' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }])
        ->with(['urinalysis' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }])
        ->with(['xray' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }])
        ->with(['dental' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }])
        ->with(['medicalCertificate' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }])
        ->with(['physicalExam' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }])
        ->selectRaw('clients.*,CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name')
        ->find($request->id));
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

    /**
     * Get all the departments to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        // all clients with their infirmary records count
        $query = Client::withCount('hematology')
            ->withCount('fecalysis')
            ->withCount('urinalysis')
            ->withCount('xray')
            ->withCount('dental')
            ->withCount('physicalExam')
            ->selectRaw('CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name')
            ->groupBy('clients.infirmary_id');

        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'clients.infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                       $q->where('clients.infirmary_id', 'like', '%' . $search . '%')
                            ->orWhere('clients.last_name', 'like', '%' . $search . '%')
                            ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                            ->orWhere('clients.middle_name', 'like', '%' . $search . '%')
                            ->orWhere('clients.suffix', 'like', '%' . $search . '%');
                } elseif ($searchBy == 'name'){
                    $q->where('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%');
                }
                else {
                    $q->where('clients.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'clients.infirmary_id');
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
            'totalRecords' => $totalRecords,
        ]);
    }
}
