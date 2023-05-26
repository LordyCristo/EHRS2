<?php

use App\Http\Controllers\API\ClientApi;
use App\Http\Controllers\API\CollegeApi;
use App\Http\Controllers\API\DegreeProgramApi;
use App\Http\Controllers\API\DepartmentApi;
use App\Http\Controllers\API\HematologyApi;
use App\Http\Controllers\API\ServiceApi;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DegreeProgramController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HematologyController;
use App\Http\Controllers\PatientInformationController;
use App\Http\Controllers\ServiceController;
use App\Models\College;
use App\Models\DegreeProgram;
use App\Models\Department;
use App\Models\HematologyRecord;
use App\Models\Services;
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
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'dataSummary'])->name('api.dashboard');
    });

    Route::prefix('clients')->group(callback: function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index');
        Route::get('/new', [ClientController::class, 'create'])->name('client.create');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');

        Route::prefix('api')->group(callback: function () {
            // Client GET ALL route
            Route::get('/', [ClientApi::class, 'index'])->name('api.client.index');
            // Client STORE route
            Route::post('/', [ClientApi::class, 'store'])->name('api.client.store');
            // Client UPDATE route
            Route::put('/{id}', [ClientApi::class, 'update'])->name('api.client.update');
            // Client DELETE route
            Route::delete('/{id}', [ClientApi::class, 'destroy'])->name('api.client.destroy');
            // Client DATATABLE API route
            Route::get('/all', [ClientApi::class, 'tableApi'])->name('api.client.table');
            // Client import from a CSV file
            Route::post('/import', [ClientApi::class, 'import'])->name('api.client.import');
        });
    });



    Route::prefix('records')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Records/RecordIndex');
        })->name('records');

        Route::get('/new', function () {
            return Inertia::render('Records/NewRecord',[
                'department_ids' => Department::select(['id', 'name'])->get(),
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
            return Inertia::render('Laboratory/LaboratoryIndex',[
                'hematologyCount' => HematologyRecord::count(),
            ]);
        })->name('laboratory.index');

        Route::prefix('/hematology')->group(function () {
            Route::get('/', [HematologyController::class, 'index'])->name('laboratory.hematology.index');
            Route::get('/new', [HematologyController::class, 'create'])->name('laboratory.hematology.create');
            Route::get('/edit/{id}', [HematologyController::class, 'edit'])->name('laboratory.hematology.edit');
            Route::prefix('api')->group(function (){
                // Hematology GET ALL route
                Route::get('/', [HematologyApi::class, 'index'])->name('api.hematology.index');
                // Hematology STORE route
                Route::post('/', [HematologyApi::class, 'store'])->name('api.hematology.store');
                // Hematology UPDATE route
                Route::put('/{id}', [HematologyApi::class, 'update'])->name('api.hematology.update');
                // Hematology DELETE route
                Route::delete('/{id}', [HematologyApi::class, 'destroy'])->name('api.hematology.destroy');
                // Hematology DATATABLE API route
                Route::get('/all', [HematologyApi::class, 'tableApi'])->name('api.hematology.table');
                // Hematology import from a CSV file
                Route::post('/import', [HematologyApi::class, 'import'])->name('api.hematology.import');
            });
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
                'collegesCount' => College::count(),
                'departmentsCount' => Department::count(),
                'programsCount' => DegreeProgram::count(),
                'servicesCount' => Services::count(),
            ]);
        })->name('more.pages');

        Route::prefix('college')->group(function(){
            Route::get('/', [CollegeController::class, 'index'])->name('more.college.index');
            Route::get('/new', [CollegeController::class, 'create'])->name('more.college.create');
            Route::get('/edit/{id}', [CollegeController::class, 'edit'])->name('more.college.edit');
            Route::prefix('api')->group(function (){
                // Colleges GET ALL route
                Route::get('/', [CollegeApi::class, 'index'])->name('api.college.index');
                // Colleges STORE route
                Route::post('/', [CollegeApi::class, 'store'])->name('api.college.store');
                // Colleges UPDATE route
                Route::put('/{id}', [CollegeApi::class, 'update'])->name('api.college.update');
                // Colleges DELETE route
                Route::delete('/{id}', [CollegeApi::class, 'destroy'])->name('api.college.destroy');
                // Colleges DATATABLE API route
                Route::get('/all', [CollegeApi::class, 'tableApi'])->name('api.college.table');
                // Colleges import from a CSV file
                Route::post('/import', [CollegeApi::class, 'import'])->name('api.college.import');
            });
        });

        Route::prefix('department')->group(function(){
            Route::get('/', [DepartmentController::class, 'index'])->name('more.department.index');
            Route::get('/new',[DepartmentController::class, 'create'])->name('more.department.create');
            Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('more.department.edit');
            Route::prefix('api')->group(function(){
                // Department GET ALL route
                Route::get('/', [DepartmentApi::class, 'index'])->name('api.department.index');
                // Department STORE route
                Route::post('/', [DepartmentApi::class, 'store'])->name('api.department.store');
                // Department UPDATE route
                Route::put('/{id}', [DepartmentApi::class, 'update'])->name('api.department.update');
                // Department DELETE route
                Route::delete('/{id}', [DepartmentApi::class, 'destroy'])->name('api.department.destroy');
                // Department DATATABLE API route
                Route::get('/all', [DepartmentApi::class, 'tableApi'])->name('api.department.table');
                // Department import from a CSV file
                Route::post('/import', [DepartmentApi::class, 'import'])->name('api.department.import');
            });
        });

        Route::prefix('program')->group(function(){
            Route::get('/', [DegreeProgramController::class, 'index'])->name('more.program.index');
            Route::get('/new', [DegreeProgramController::class, 'create'])->name('more.program.create');
            Route::get('/edit/{id}', [DegreeProgramController::class, 'edit'])->name('more.program.edit');
            Route::prefix('api')->group(function(){
                // Degree Program GET ALL route
                Route::get('/', [DegreeProgramApi::class, 'index'])->name('api.program.index');
                // Degree Program STORE route
                Route::post('/', [DegreeProgramApi::class, 'store'])->name('api.program.store');
                // Degree Program UPDATE route
                Route::put('/{id}', [DegreeProgramApi::class, 'update'])->name('api.program.update');
                // Degree Program DELETE route
                Route::delete('/{id}', [DegreeProgramApi::class, 'destroy'])->name('api.program.destroy');
                // Degree Program DATATABLE API route
                Route::get('/all', [DegreeProgramApi::class, 'tableApi'])->name('api.program.table');
                // Degree Program import from a CSV file
                Route::post('/import', [DegreeProgramApi::class, 'import'])->name('api.program.import');
            });
        });

        Route::prefix('service')->group(function (){
            Route::get('/', [ServiceController::class, 'index'])->name('more.service.index');
            Route::get('/new', [ServiceController::class, 'create'])->name('more.service.create');
            Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('more.service.edit');
            Route::prefix('api')->group(function(){
                // Services GET ALL route
                Route::get('/', [ServiceApi::class, 'index'])->name('api.service.index');
                // Services STORE route
                Route::post('/', [ServiceApi::class, 'store'])->name('api.service.store');
                // Services UPDATE route
                Route::put('/{id}', [ServiceApi::class, 'update'])->name('api.service.update');
                // Services DELETE route
                Route::delete('/{id}', [ServiceApi::class, 'destroy'])->name('api.service.destroy');
                // Services DATATABLE API route
                Route::get('/all', [ServiceApi::class, 'tableApi'])->name('api.service.table');
                // Services import from a CSV file
                Route::post('/import', [ServiceApi::class, 'import'])->name('api.service.import');
            });
        });
    });
});
