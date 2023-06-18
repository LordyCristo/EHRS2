<?php

use App\Http\Controllers\API\ERDetailApi;
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
    return AccountRole::select(['id', 'name'])->whereNotIn('id', [1])->orderBy('id')->get();
})->name('api.roles');

