<?php

use App\Http\Controllers\API\DepartmentApi;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\DegreeProgramController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HematologyController;
use App\Http\Controllers\PatientInformationController;
use App\Http\Controllers\ServiceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('clients')->group(callback: function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index');
        Route::get('/new', [ClientController::class, 'create'])->name('client.create');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    });

    Route::prefix('records')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Records/RecordIndex');
        })->name('records');

        Route::get('/new', function () {
            return Inertia::render('Records/NewRecord',[
                'department_ids' => \App\Models\Department::select(['id', 'name'])->get(),
            ]);
        })->name('newRecord');

        Route::get('/edit', function () {
            return Inertia::render('Records/EditRecord');
        })->name('editRecord');
    });

    Route::get('/radiology', function () {
        return Inertia::render('Radiology/RadiologyDashboard');
    })->name('radiology');

    Route::get('/dental', function () {
        return Inertia::render('Dental');
    })->name('dental');

    Route::prefix('/laboratory')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Laboratory/LaboratoryIndex');
        })->name('laboratory.index');

        Route::prefix('/hematology')->group(function () {
            Route::get('/', [HematologyController::class, 'index'])->name('laboratory.hematology.index');
            Route::get('/new', [HematologyController::class, 'create'])->name('laboratory.hematology.create');
            Route::get('/edit/{id}', [HematologyController::class, 'edit'])->name('laboratory.hematology.edit');
        });
    });

    Route::get('/surgery', function () {
        return Inertia::render('Surgery');
    })->name('surgery');

    Route::get('/maternity', function () {
        return Inertia::render('Maternity');
    })->name('maternity');

    Route::get('/ward', function () {
        return Inertia::render('Ward');
    })->name('ward');

    Route::prefix('more')->group(function () {
        Route::get('/', function () {
            return Inertia::render('MorePages/MorePageIndex',[
                'collegesCount' => \App\Models\College::count(),
                'departmentsCount' => \App\Models\Department::count(),
                'programsCount' => \App\Models\DegreeProgram::count(),
                'servicesCount' => \App\Models\Services::count(),
            ]);
        })->name('more.pages');

        Route::prefix('/college')->group(function(){
            Route::get('/', [CollegeController::class, 'index'])->name('more.college.index');
            Route::get('/new', [CollegeController::class, 'create'])->name('more.college.create');
            Route::get('/edit/{id}', [CollegeController::class, 'edit'])->name('more.college.edit');
        });

        Route::prefix('/department')->group(function(){
            Route::get('/', [DepartmentController::class, 'index'])->name('more.department.index');
            Route::get('/new',[DepartmentController::class, 'create'])->name('more.department.create');
            Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('more.department.edit');
        });

        Route::prefix('/program')->group(function(){
            Route::get('/', [DegreeProgramController::class, 'index'])->name('more.program.index');
            Route::get('/new', [DegreeProgramController::class, 'create'])->name('more.program.create');
            Route::get('/edit/{id}', [DegreeProgramController::class, 'edit'])->name('more.program.edit');
        });

        Route::prefix('/service')->group(function (){
            Route::get('/', [ServiceController::class, 'index'])->name('more.service.index');
            Route::get('/new', [ServiceController::class, 'create'])->name('more.service.create');
            Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('more.service.edit');
        });
    });
});
