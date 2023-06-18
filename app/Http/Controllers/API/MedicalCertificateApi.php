<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalCertificateRequest;
use App\Models\MedicalCertificate;
use Illuminate\Http\Request;

class MedicalCertificateApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
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
