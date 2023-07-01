<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalCertificateRequest;
use App\Http\Resources\MedicalRecordResource;
use App\Models\Client;
use App\Models\MedicalCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class MedicalCertificateApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Records/MedicalCertificate',[
            'data' => new MedicalRecordResource(Client::withCount('hematology')
                ->withCount('fecalysis')
                ->withCount('urinalysis')
                ->withCount('xray')
                ->where('infirmary_id', request()->id)
                ->whereYear('created_at', Carbon::now()->year)
                ->first()),
            'physicians' => User::selectRaw('id, CONCAT(first_name, " ", last_name) as name')->where('role',2)->get(),
        ]);
    }

    public function printable(Request $request){
        return Inertia::render('Records/MedicalCertificatePrintable', [
            'data' => new MedicalRecordResource(MedicalCertificate::with('client')->with('physician')->findOrFail($request->id)),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicalCertificateRequest $request)
    {
        $record = MedicalCertificate::create($request->validated());
        if ($record){
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
        ])->setStatusCode(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return Client::join('medical_certificates', 'clients.infirmary_id', '=', 'medical_certificates.infirmary_id')
            ->where('clients.id', $request->id)
            ->select('clients.id','clients.infirmary_id','clients.first_name','clients.middle_name','clients.last_name','clients.suffix','cbc','urinalysis','fecalysis','drug_test','chest_xray','psychological','neuropsychiatric','nolabneeded','is_fit','purpose','purpose_sport','specific_purpose','remarks','physician_id','medical_certificates.created_at')
            ->orderBy('medical_certificates.created_at', 'desc')
            ->first();
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
