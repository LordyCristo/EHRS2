<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DentalCertifcateRequest;
use App\Http\Requests\DentalRequest;
use App\Http\Resources\DentalCollection;
use App\Models\Dental;
use App\Models\DentalCertificate;
use App\Models\DentalRecord;
use Illuminate\Http\Request;

class DentalApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new DentalCollection(DentalRecord::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DentalRequest $request)
    {
        $dental = Dental::create($request->all());
        $record = $dental->dentalRecord()->create([
            'infirmary_id' => $request->infirmary_id,
            'dentist' => $request->dentist,
            'or_no' => $request->or_no,
            'is_out_patient' => $request->is_out_patient,
            'status' => $request->status,
        ]);
        if(!$record)
            $dental->delete();
        return response()->json([
            'message' => 'Dental record created successfully',
            'data' => null,
        ]);
    }

    /**
     * Store Dental Certificate
     */
    public function certificate(DentalCertifcateRequest $request){
        $record = DentalCertificate::create($request->validated());
        if($record){
            return response()->json([
                'data' => $record,
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully created Medical Certificate with id '.$record->id,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => $record,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to create Medical Certificate',
            ]
        ])->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DentalRequest $request)
    {
        $dental = Dental::findOrFail($request->id);
        $dental->update(
            $request->all()
        );
        //update dental record
       $dental->dentalRecord()->update([
            'infirmary_id' => $request->infirmary_id,
            'dentist' => $request->dentist,
            'or_no' => $request->or_no,
            'is_out_patient' => $request->is_out_patient,
            'status' => $request->status,
        ]);
        return response()->json([
            'message' => 'Dental record updated successfully',
            'data' => $dental,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        $temp1 = DentalRecord::destroy($id);
        $temp2 = Dental::destroy($id);
        if(!$temp1 || !$temp2)
            return response()->json([
                'message' => 'Failed to delete dental record',
            ], 500);
        return response()->json([
            'message' => 'Dental record deleted successfully',
        ]);
    }


    public function tableApi(Request $request)
    {
        $query = DentalRecord::join('clients', 'dental_records.infirmary_id', '=', 'clients.infirmary_id')
            ->join('dental_treatment_records', 'dental_treatment_records.dental_record_id', '=', 'dental_records.id')
            ->groupBy('dental_records.id')
            ->selectRaw('dental_records.*, COUNT(dental_treatment_records.id) as treatment_count, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('dental_records.infirmary_id', 'like', '%' . $search . '%')
                        ->orwhere('dental_records.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhereRaw('CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) LIKE ?', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                } elseif ($searchBy == 'name'){
                    $q->where('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%');
                } else {
                    $q->where('dental_records.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'dental_records.id');
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
