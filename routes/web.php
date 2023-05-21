<?php

use App\Http\Controllers\API\DepartmentApi;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PatientInformationController;
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

    Route::prefix('patients')->group(callback: function () {
        Route::get('/', function () {
            return Inertia::render('Patient/PatientIndex');
        })->name('patients');
        Route::get('/new', [PatientInformationController::class, 'create'])->name('newPatient');
        Route::get('/edit/{id}', [PatientInformationController::class, 'edit'])->name('editPatient');
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

    Route::get('/laboratory', function () {
        return Inertia::render('Laboratories');
    })->name('laboratory');

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
            return Inertia::render('MorePages');
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
    });
});
