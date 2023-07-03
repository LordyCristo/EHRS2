<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DentalTreatmentRequest;
use App\Http\Resources\DataCollection;
use App\Http\Resources\DentalResource;
use App\Models\Client;
use App\Models\DentalRecord;
use App\Models\DentalTreatment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DentalTreatmentApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new DataCollection(DentalTreatment::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = $request->all();
        $dental_record = DentalRecord::findOrFail($request->dental_record_id);
        //for each row in rows
        foreach ($request->rows as $row) {
            //check first if the record already exists
            $record = DentalTreatment::where('dental_record_id', $request->dental_record_id)
                ->where('service_id', $row['service_id'])
                ->where('tooth_location', $row['tooth_location'])
                ->where('operator', $row['operator'])
                ->first();
            if ($record) {
                //update the record
                $record->update([
                    'diagnosis' => $row['diagnosis'],
                ]);
                continue;
            }
            //create a new record
            $dental_record->treatments()->create([
                'diagnosis' => $row['diagnosis'],
                'service_id' => $row['service_id'],
                'tooth_location' => $row['tooth_location'],
                'operator' => $row['operator'],
            ]);
        }
        return response()->json([
            'data' => new DentalResource($record),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $record?'success':'failed',
                'message' => $record?'Successfully created Dental treatment with id ':'Failed to create Dental treatment record',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $record = DentalTreatment::findOrFail($request->id);
        $record->update($request->all());
        return response()->json([
            'data' => (new DentalResource($record)),
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $record?'success':'failed',
                'message' => $record?'Successfully updated Dental treatment with id '.$record->id:'Failed to update Dental treatment record',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $record = DentalTreatment::findOrFail($request->id);
        $record->delete();
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $record?'success':'failed',
                'message' => $record?'Successfully deleted Dental treatment with id '.$record->id:'Failed to delete Dental treatment record',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Display a listing of the resource.
     */
    public function getTreatments(Request $request){
        return new DataCollection(DentalTreatment::join('dental_records','dental_records.id','=','dental_treatment_records.dental_record_id')
            ->join('dentals','dentals.id','=','dental_records.dental_result_id')
            ->join('clients','clients.infirmary_id','=','dental_records.infirmary_id')
            ->where('clients.infirmary_id',$request->id)
            ->get());
    }

    public function tableApi(Request $request): JsonResponse
    {
//        $query = DentalTreatment::join('dental_records', 'dental_records.id', '=', 'dental_treatment_records.dental_record_id')
//            ->join('clients', 'dental_records.infirmary_id', '=', 'clients.infirmary_id')
//            ->selectRaw('COUNT(dental_treatment_records.id) as treatment_count, dental_records.id as id, clients.infirmary_id, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name')
//            ->groupBy('dental_treatment_records.id');
        // Handle search
        $query = Client::join('dental_records', 'dental_records.infirmary_id', '=', 'clients.infirmary_id')
            ->join('dental_treatment_records', 'dental_treatment_records.dental_record_id', '=', 'dental_records.id')
            ->selectRaw('dental_records.id, COUNT(dental_treatment_records.id) as treatment_count, clients.infirmary_id, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name')
            ->orderBy('dental_records.id', 'desc')
            ->groupBy('dental_records.id');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'dental_records.infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('dental_treatment_records.dental_record_id', 'like', '%' . $search . '%')
                        ->orwhere('dental_records.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhereRaw('CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) LIKE ?', '%' . $search . '%');
                } elseif ($searchBy == 'name'){
                    $q->where('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%');
                } else {
                    $q->where('dental_treatment_records.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'dental_treatment_records.id');
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
