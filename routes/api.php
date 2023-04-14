<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\AccountType;
use App\Models\Client;
use App\Http\Controllers\PatientInformationController;
use App\Http\Controllers\DashboardController;
use App\Models\DegreeProgram;
use App\Models\Department;
use App\Models\ClientType;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/roles', function () {
    return AccountType::select(['id', 'name'])->get();
})->name('api.roles');

Route::get('/universityDB', function(){
    return response()->json([
        'degree_programs' => DegreeProgram::select(['id', 'name'])->orderBy('id', 'asc')->get(),
        'departments' => Department::select(['id', 'name'])->orderBy('id', 'asc')->get(),
        'client_types' => ClientType::select(['id', 'name'])->orderBy('id', 'asc')->get(),
    ]);
})->name('api.universityDB');

//Route::middleware('auth:sanctum')->group(function () {
    // To store the patient information
    Route::post('/patient', [PatientInformationController::class, 'store'])->name('api.patient.store');
    // To retreive a patient information
    Route::get('/patient/{id}', [PatientInformationController::class, 'show'])->name('api.patient.show');
    // API for the patient information Datatable
    Route::get('/patients', [PatientInformationController::class, 'index'])->name('api.patients');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('api.dashboard');
//});


