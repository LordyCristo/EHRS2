<?php

use App\Http\Controllers\API\ClientApi;
use App\Http\Controllers\API\CollegeApi;
use App\Http\Controllers\API\DegreeProgramApi;
use App\Http\Controllers\API\DepartmentApi;
use App\Http\Controllers\API\HematologyApi;
use App\Http\Controllers\API\ServiceApi;
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

// Degree Program GET ALL route
Route::get('/programs', [DegreeProgramApi::class, 'index'])->name('api.program.index');
// Degree Program STORE route
Route::post('/programs', [DegreeProgramApi::class, 'store'])->name('api.program.store');
// Degree Program UPDATE route
Route::put('/programs/{id}', [DegreeProgramApi::class, 'update'])->name('api.program.update');
// Degree Program DELETE route
Route::delete('/programs/{id}', [DegreeProgramApi::class, 'destroy'])->name('api.program.destroy');
// Degree Program DATATABLE API route
Route::get('/programs/all', [DegreeProgramApi::class, 'tableApi'])->name('api.program.table');
// Degree Program import from a CSV file
Route::post('/programs/import', [DegreeProgramApi::class, 'import'])->name('api.program.import');

// Services GET ALL route
Route::get('/services', [ServiceApi::class, 'index'])->name('api.service.index');
// Services STORE route
Route::post('/services', [ServiceApi::class, 'store'])->name('api.service.store');
// Services UPDATE route
Route::put('/services/{id}', [ServiceApi::class, 'update'])->name('api.service.update');
// Services DELETE route
Route::delete('/services/{id}', [ServiceApi::class, 'destroy'])->name('api.service.destroy');
// Services DATATABLE API route
Route::get('/services/all', [ServiceApi::class, 'tableApi'])->name('api.service.table');
// Services import from a CSV file
Route::post('/services/import', [ServiceApi::class, 'import'])->name('api.service.import');


// Client GET ALL route
Route::get('/clients', [ClientApi::class, 'index'])->name('api.client.index');
// Client STORE route
Route::post('/clients', [ClientApi::class, 'store'])->name('api.client.store');
// Client UPDATE route
Route::put('/clients/{id}', [ClientApi::class, 'update'])->name('api.client.update');
// Client DELETE route
Route::delete('/clients/{id}', [ClientApi::class, 'destroy'])->name('api.client.destroy');
// Client DATATABLE API route
Route::get('/clients/all', [ClientApi::class, 'tableApi'])->name('api.client.table');
// Client import from a CSV file
Route::post('/clients/import', [ClientApi::class, 'import'])->name('api.client.import');

// Hematology GET ALL route
Route::get('/hematology', [HematologyApi::class, 'index'])->name('api.hematology.index');
// Hematology STORE route
Route::post('/hematology', [HematologyApi::class, 'store'])->name('api.hematology.store');
// Hematology UPDATE route
Route::put('/hematology/{id}', [HematologyApi::class, 'update'])->name('api.hematology.update');
// Hematology DELETE route
Route::delete('/hematology/{id}', [HematologyApi::class, 'destroy'])->name('api.hematology.destroy');
// Hematology DATATABLE API route
Route::get('/hematology/all', [HematologyApi::class, 'tableApi'])->name('api.hematology.table');
// Hematology import from a CSV file
Route::post('/hematology/import', [HematologyApi::class, 'import'])->name('api.hematology.import');




// Dashboard summary API
Route::get('/dashboard', [DashboardController::class, 'index'])->name('api.dashboard');
