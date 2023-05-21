<?php

use App\Http\Controllers\API\CollegeApi;
use App\Http\Controllers\API\DepartmentApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\AccountRole;
use App\Models\Client;
use App\Http\Controllers\PatientInformationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Models\DegreeProgram;
use App\Models\Department;
use App\Models\ClientType;
use Illuminate\Support\Facades\DB;
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
    return AccountRole::select(['id', 'name'])->get();
})->name('api.roles');

Route::get('/flags', function(){
    return response()->json([
        'degree_programs' => DegreeProgram::select(['id', DB::raw("CONCAT(`name`, IFNULL(CONCAT(' major in ', `major`), '')) AS `name`")])->orderBy('id', 'asc')->get(),
        //'departments' => Department::select(['id', 'name'])->orderBy('id', 'asc')->get(),
        'client_types' => ClientType::select(['id', 'name'])->orderBy('id', 'asc')->get(),
        'last_client_id' => Client::select('id')->orderBy('id', 'desc')->first()->id ?? '0',
    ]);
})->name('api.flags');

Route::get('/departments', function () {
    return Department::select(['id', 'name'])->get();
})->name('api.departments');



//Sample APIs' for the patient information
Route::get('/programs', [DepartmentController::class, 'index'])->name('api.programs');
Route::post('/program', [DepartmentController::class, 'store'])->name('api.program.store');
Route::get('/program/{id}', [DepartmentController::class, 'edit'])->name('api.program.edit');
Route::put('/program/{id}', [DepartmentController::class, 'update'])->name('api.program.update');
Route::delete('/program/{id}', [DepartmentController::class, 'destroy'])->name('api.program.destroy');

// Colleges GET ALL route
Route::get('/colleges', [CollegeApi::class, 'index'])->name('api.college.index');
// Colleges STORE route
Route::post('/colleges', [CollegeApi::class, 'store'])->name('api.college.store');
// Colleges UPDATE route
Route::put('/colleges/{id}', [CollegeApi::class, 'update'])->name('api.college.update');
// Colleges DELETE route
Route::delete('/colleges/{id}', [CollegeApi::class, 'destroy'])->name('api.college.destroy');
// Colleges DATATABLE API route
Route::get('/colleges/all', [CollegeApi::class, 'tableApi'])->name('api.college.table');
// Colleges import from a CSV file
Route::post('/colleges/import', [CollegeApi::class, 'import'])->name('api.college.import');

// Department GET ALL route
Route::get('/departments', [DepartmentApi::class, 'index'])->name('api.department.index');
// Department STORE route
Route::post('/departments', [DepartmentApi::class, 'store'])->name('api.department.store');
// Department UPDATE route
Route::put('/departments/{id}', [DepartmentApi::class, 'update'])->name('api.department.update');
// Department DELETE route
Route::delete('/departments/{id}', [DepartmentApi::class, 'destroy'])->name('api.department.destroy');
// Department DATATABLE API route
Route::get('/departments/all', [DepartmentApi::class, 'tableApi'])->name('api.department.table');
// Department import from a CSV file
Route::post('/departments/import', [DepartmentApi::class, 'import'])->name('api.department.import');


// Get all the patient information for the datatable api
Route::get('/patient', [PatientInformationController::class, 'index'])->name('api.patients');
// Get all the patient information to be exported as CSV file
Route::get('/patient/all', [PatientInformationController::class, 'getAll'])->name('api.patient.all');
// Import the patient information from a CSV file
Route::post('/patient/import', [PatientInformationController::class, 'import'])->name('api.patient.import');
// To store the patient information
Route::post('/patient', [PatientInformationController::class, 'store'])->name('api.patient.store');
// To update the patient information
Route::put('/patient/{id}', [PatientInformationController::class, 'update'])->name('api.patient.update');
// To delete a patient information
Route::delete('/patient/{id}', [PatientInformationController::class, 'destroy'])->name('api.patient.destroy');


// Dashboard summary API
Route::get('/dashboard', [DashboardController::class, 'index'])->name('api.dashboard');
