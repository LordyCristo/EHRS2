<?php

use App\Http\Controllers\API\ApprovalApi;
use App\Http\Controllers\API\ClientApi;
use App\Http\Controllers\API\DentalApi;
use App\Http\Controllers\API\ERDetailApi;
use App\Http\Controllers\API\CollegeApi;
use App\Http\Controllers\API\DegreeProgramApi;
use App\Http\Controllers\API\DepartmentApi;
use App\Http\Controllers\API\FecalysisApi;
use App\Http\Controllers\API\FeeApi;
use App\Http\Controllers\API\HematologyApi;
use App\Http\Controllers\API\MedicalCertificateApi;
use App\Http\Controllers\API\MedicalRecordApi;
use App\Http\Controllers\API\PaymentApi;
use App\Http\Controllers\API\RadiologyRequestApi;
use App\Http\Controllers\API\RadiologyResultAPI;
use App\Http\Controllers\API\ServiceApi;
use App\Http\Controllers\API\UrinalysisApi;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DentalController;
use App\Http\Controllers\ERDetailContoller;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DegreeProgramController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FecalysisController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\HematologyController;
use App\Http\Controllers\PatientInformationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RadiologyRequestController;
use App\Http\Controllers\RadiologyResultController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UrinalysisController;
use App\Http\Resources\DentalResource;
use App\Http\Resources\MedicalRecordResource;
use App\Models\Client;
use App\Models\College;
use App\Models\DegreeProgram;
use App\Models\Dental;
use App\Models\DentalRecord;
use App\Models\DentalTreatment;
use App\Models\Department;
use App\Models\FecalysisRecord;
use App\Models\Fees;
use App\Models\HematologyRecord;
use App\Models\MedicalCertificate;
use App\Models\Payment;
use App\Models\PaymentsService;
use App\Models\Services;
use App\Models\UrinalysisRecord;
use App\Models\User;
use App\Models\Xray;
use App\Models\XrayRequest;
use Carbon\Carbon;
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

// Public registration access
// Recommend to be removed in production
// Route::prefix('/public')->middleware('auth:sanctum')->group(function(){
// Route::get('/client/new', [ClientController::class, 'public'])->name('public.client');
// Route::post('/', [ClientApi::class, 'store'])->name('api.public.client.store');
//});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'dataSummary'])->name('api.dashboard');
        Route::get('/monthlysummary', [DashboardController::class, 'byCollege'])->name('api.monthly.summary');
        Route::get('/summary', [DashboardController::class, 'summary'])->name('api.summary');
        Route::get('/monthly', [DashboardController::class, 'monthly'])->name('api.monthly');
    });

    // Routes for the User Approval Section
    Route::prefix('approve')->middleware('aacm')->group(callback: function () {
        Route::get('/', [ApprovalApi::class, 'index'])->name('user.approve');
        Route::prefix('api')->group(callback: function () {
            Route::get('/all', [ApprovalApi::class, 'tableApi'])->name('api.user.approval');
            Route::put('/approve/{id}', [ApprovalApi::class, 'approve'])->name('api.user.approve');
            Route::put('/reject/{id}', [ApprovalApi::class, 'reject'])->name('api.user.reject');
        });
    });


    // Routes for the Client Management Section
    Route::prefix('clients')->middleware('ioacm')->group(callback: function () {
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

    // Routes for the Medical Certificates
    Route::prefix('records')->middleware('aacm')->group(callback: function () {
        Route::get('/medical-certificate/{id}', function (){
            return Inertia::render('Records/MedicalCertificate',[
                'data' => new MedicalRecordResource(Client::withCount('hematology')
                    ->withCount('fecalysis')
                    ->withCount('urinalysis')
                    ->withCount('xray')
                    ->where('infirmary_id', request()->id)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->first()),
                'physicians' => User::selectRaw('CONCAT(first_name, " ", last_name) as name, id')->get()
            ]);
        })->name('records.medcert');
        Route::prefix('api')->group(callback: function () {
            Route::post('/new', [MedicalCertificateApi::class, 'store'])->name('api.certificate.store');
            Route::get('/show/{id}', [MedicalCertificateApi::class, 'show'])->name('api.certificate.show');
            Route::get('/', [MedicalRecordApi::class, 'index'])->name('api.record.export');
        });
    });

    // Routes for Medical Records
    Route::prefix('records')->middleware('aacm')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Records/RecordIndex');
        })->name('records');

        Route::get('/new', function () {
            return Inertia::render('Records/NewRecord',[
                'department_ids' => Department::select(['id', 'name'])->get()
            ]);
        })->name('newRecord');

        Route::get('/edit/{id}', function () {
            return Inertia::render('Records/EditRecord');
        })->name('editRecord');

        Route::get('/show/{id}', function () {
            return Inertia::render('Records/ViewRecord',[
                'data' => new MedicalRecordResource( Client::with('hematology')
                    ->with('fecalysis')
                    ->with('urinalysis')
                    ->with('xray')
                    ->with('dental')
                    ->with('medicalCertificate')
                    ->selectRaw('clients.*,CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(" ",clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name')
                    ->find(request()->id)),
            ]);
        })->name('records.show');

        Route::prefix('/api')->group(function (){
            Route::get('/all', [MedicalRecordApi::class, 'tableApi'])->name('api.record.index');
        });

        Route::get('/api/medical-certificate', [MedicalRecordApi::class, 'medicalCertificate'])->name('api.record.medcert');
    });

    Route::prefix('/emergency')->group(function () {
        Route::get('/', [ERDetailContoller::class, 'index'])->name('er.index');
        Route::get('/new', [ERDetailContoller::class, 'create'])->name('er.new.client');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('er.edit.client');
        //Route::get('/show', [ERDetailContoller::class, 'show'])->name('er.show.client');
        Route::prefix('/api')->group(function () {
            // Emergency Room GET ALL route
            Route::get('/', [ERDetailApi::class, 'index'])->name('api.er.index');
            // Emergency Room STORE route
            Route::post('/', [ClientApi::class, 'store'])->name('api.er.store');
            // Emergency Room UPDATE route
            Route::put('/{id}', [ClientApi::class, 'update'])->name('api.er.update');
            // Emergency Room DELETE route
            Route::delete('/{id}', [ERDetailApi::class, 'destroy'])->name('api.er.destroy');
            // Emergency Room DATATABLE API route
            Route::get('/all', [ERDetailApi::class, 'tableApi'])->name('api.er.table');
            // Emergency Room import from a CSV file
            Route::post('/import', [ERDetailApi::class, 'import'])->name('api.er.import');
        });
    });

    // Routes for the Radiology Section
    Route::prefix('radiology')->middleware('racm')->group(function(){
        // Radiology index page
        Route::get('/', function (){
            return Inertia::render('Radiology/RadiologyIndex',[
                'requestsCount' => XrayRequest::count(),
                'resultsCount' => Xray::count(),
            ]);
        })->name('radiology.index');
        // Routes to handle Xray requests
        Route::prefix('/request')->group(function(){
            Route::get('/', [RadiologyRequestController::class, 'index'])->name('radiology.request.index');
            Route::get('/new', [RadiologyRequestController::class, 'create'])->name('radiology.request.create');
            Route::get('/edit/{id}', [RadiologyRequestController::class, 'edit'])->name('radiology.request.edit');
            Route::get('/show/{id}', [RadiologyRequestController::class, 'show'])->name('radiology.request.show');
            Route::prefix('api')->group(function (){
                // Radiology GET ALL route
                Route::get('/', [RadiologyRequestApi::class, 'index'])->name('api.radiology.request.index');
                // Radiology STORE route
                Route::post('/', [RadiologyRequestApi::class, 'store'])->name('api.radiology.request.store');
                // Radiology UPDATE route
                Route::put('/{id}', [RadiologyRequestApi::class, 'update'])->name('api.radiology.request.update');
                // Radiology DELETE route
                Route::delete('/{id}', [RadiologyRequestApi::class, 'destroy'])->name('api.radiology.request.destroy');
                // Radiology DATATABLE API route
                Route::get('/all', [RadiologyRequestApi::class, 'tableApi'])->name('api.radiology.request.table');
            });
        });
        // Routes to handle radiology results
        Route::prefix('/result')->group(function(){
            Route::get('/', [RadiologyResultController::class, 'index'])->name('radiology.result.index');
            Route::get('/new', [RadiologyResultController::class, 'create'])->name('radiology.result.create');
            Route::get('/edit/{id}', [RadiologyResultController::class, 'edit'])->name('radiology.result.edit');
            Route::get('/show/{id}', [RadiologyResultController::class, 'show'])->name('radiology.result.show');
            Route::prefix('api')->group(function (){
                // Radiology GET ALL route
                Route::get('/', [RadiologyResultAPI::class, 'index'])->name('api.radiology.result.index');
                // Radiology STORE route
                Route::post('/', [RadiologyResultAPI::class, 'store'])->name('api.radiology.result.store');
                // Radiology UPDATE route
                Route::put('/{id}', [RadiologyResultAPI::class, 'update'])->name('api.radiology.result.update');
                // Radiology DELETE route
                Route::delete('/{id}', [RadiologyResultAPI::class, 'destroy'])->name('api.radiology.result.destroy');
                // Radiology DATATABLE API route
                Route::get('/all', [RadiologyResultAPI::class, 'tableApi'])->name('api.radiology.result.table');
            });
        });
    });

    // Routes for the Dental Section
    Route::prefix('dental')->middleware('dacm')->group(function(){
        Route::get('/', [DentalController::class, 'index'])->name('dental.index');
        Route::get('/new', [DentalController::class, 'create'])->name('dental.create');
        Route::get('/edit/{id}', [DentalController::class, 'edit'])->name('dental.edit');
        Route::get('/show/{id}', [DentalController::class, 'show'])->name('dental.show');
        Route::prefix('api')->group(function (){
            // Dental GET ALL route
            Route::get('/', [DentalApi::class, 'index'])->name('api.dental.index');
            // Dental STORE route
            Route::post('/', [DentalApi::class, 'store'])->name('api.dental.store');
            // Dental UPDATE route
            Route::put('/{id}', [DentalApi::class, 'update'])->name('api.dental.update');
            // Dental DELETE route
            Route::delete('/{id}', [DentalApi::class, 'destroy'])->name('api.dental.destroy');
            // Dental DATATABLE API route
            Route::get('/all', [DentalApi::class, 'tableApi'])->name('api.dental.table');
        });
    });

    // Routes for the Payment Section
    Route::prefix('finance')->middleware('facm')->group(function (){
        // Finance dashboard and summary of revenue
        Route::get('/', function (){
            return Inertia::render('Finance/FinanceIndex',[
                'feesCount' => Fees::count(),
                'paymentsCount' => Payment::count(),
//                'summary' => [
//                    'totalRevenue' => PaymentsService::join('services', 'payments_service.service_id', '=', 'services.id')
//                    ->groupBy('section_name')->selectRaw('services.section_name, SUM(fee) as total')->get(),
//                ]
            ]);
        })->name('finance.index');
        // Routes to manage the fees assigned to every service offered
        Route::prefix('fee')->group(function(){
            Route::get('/', [FeeController::class, 'index'])->name('finance.fee.index');
            Route::get('/new', [FeeController::class, 'create'])->name('finance.fee.create');
            Route::get('/edit/{id}', [FeeController::class, 'edit'])->name('finance.fee.edit');
            Route::prefix('api')->group(function (){
                // Fee GET ALL route
                Route::get('/', [FeeApi::class, 'index'])->name('api.fee.index');
                // Fee STORE route
                Route::post('/', [FeeApi::class, 'store'])->name('api.fee.store');
                // Fee UPDATE route
                Route::put('/{id}', [FeeApi::class, 'update'])->name('api.fee.update');
                // Fee DELETE route
                Route::delete('/{id}', [FeeApi::class, 'destroy'])->name('api.fee.destroy');
                // Fee DATATABLE API route
                Route::get('/all', [FeeApi::class, 'tableApi'])->name('api.fee.table');
                // Fee import from a CSV file
                Route::post('/import', [FeeApi::class, 'import'])->name('api.fee.import');
                // Summary of revenue
                Route::get('/summary', [FeeApi::class, 'getRevenueApi'])->name('api.fee.revenue');
            });
        });
        // Routes for payment transactions
        Route::prefix('payment')->group(function(){
            Route::get('/', [PaymentController::class, 'index'])->name('finance.payment.index');
            Route::get('/new', [PaymentController::class, 'create'])->name('finance.payment.create');
            Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('finance.payment.edit');
            Route::get('/show/{id}', [PaymentController::class, 'show'])->name('finance.payment.show');
            Route::prefix('api')->group(function(){
                // Payment GET ALL route
                Route::get('/', [PaymentApi::class, 'index'])->name('api.payment.index');
                // Payment STORE route
                Route::post('/', [PaymentApi::class, 'store'])->name('api.payment.store');
                // Payment UPDATE route
                Route::put('/{id}', [PaymentApi::class, 'update'])->name('api.payment.update');
                // Payment DELETE route
                Route::delete('/{id}', [PaymentApi::class, 'destroy'])->name('api.payment.destroy');
                // Payment DATATABLE API route
                Route::get('/all', [PaymentApi::class, 'tableApi'])->name('api.payment.table');
                // Payment import from a CSV file
                Route::post('/import', [PaymentApi::class, 'import'])->name('api.payment.import');
            });
        });
    });

    // Routes for Laboratory Services
    Route::prefix('laboratory')->middleware('lacm')->group(function () {
        // Summary index page for laboratories
        Route::get('/', function () {
            return Inertia::render('Laboratory/LaboratoryIndex',[
                'hematologyCount' => HematologyRecord::count(),
                'fecalysisCount' => FecalysisRecord::count(),
                'urinalysisCount' => UrinalysisRecord::count(),
            ]);
        })->name('laboratory.index');
        // Routes for hematology record management
        Route::prefix('/hematology')->group(function () {
            Route::get('/', [HematologyController::class, 'index'])->name('laboratory.hematology.index');
            Route::get('/new', [HematologyController::class, 'create'])->name('laboratory.hematology.create');
            Route::get('/edit/{id}', [HematologyController::class, 'edit'])->name('laboratory.hematology.edit');
            Route::get('/show/{id}', [HematologyController::class, 'show'])->name('laboratory.hematology.show');
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
        // Routes for Fecalaysis Record Management
        Route::prefix('/fecalysis')->group(function () {
            Route::get('/', [FecalysisController::class, 'index'])->name('laboratory.fecalysis.index');
            Route::get('/new', [FecalysisController::class, 'create'])->name('laboratory.fecalysis.create');
            Route::get('/edit/{id}', [FecalysisController::class, 'edit'])->name('laboratory.fecalysis.edit');
            Route::get('/show/{id}', [FecalysisController::class, 'show'])->name('laboratory.fecalysis.show');
            Route::prefix('api')->group(function (){
                // Fecalysis GET ALL route
                Route::get('/', [FecalysisApi::class, 'index'])->name('api.fecalysis.index');
                // Fecalysis STORE route
                Route::post('/', [FecalysisApi::class, 'store'])->name('api.fecalysis.store');
                // Fecalysis UPDATE route
                Route::put('/{id}', [FecalysisApi::class, 'update'])->name('api.fecalysis.update');
                // Fecalysis DELETE route
                Route::delete('/{id}', [FecalysisApi::class, 'destroy'])->name('api.fecalysis.destroy');
                // Fecalysis DATATABLE API route
                Route::get('/all', [FecalysisApi::class, 'tableApi'])->name('api.fecalysis.table');
                // Fecalysis import from a CSV file
                Route::post('/import', [FecalysisApi::class, 'import'])->name('api.fecalysis.import');
            });
        });
        // Routes for Urinalysis Result Record Management
        Route::prefix('/urinalysis')->group(function () {
            Route::get('/', [UrinalysisController::class, 'index'])->name('laboratory.urinalysis.index');
            Route::get('/new', [UrinalysisController::class, 'create'])->name('laboratory.urinalysis.create');
            Route::get('/edit/{id}', [UrinalysisController::class, 'edit'])->name('laboratory.urinalysis.edit');
            Route::get('/show/{id}', [UrinalysisController::class, 'show'])->name('laboratory.urinalysis.show');
            Route::prefix('api')->group(function (){
                // Urinalysis GET ALL route
                Route::get('/', [UrinalysisApi::class, 'index'])->name('api.urinalysis.index');
                // Urinalysis STORE route
                Route::post('/', [UrinalysisApi::class, 'store'])->name('api.urinalysis.store');
                // Urinalysis UPDATE route
                Route::put('/{id}', [UrinalysisApi::class, 'update'])->name('api.urinalysis.update');
                // Urinalysis DELETE route
                Route::delete('/{id}', [UrinalysisApi::class, 'destroy'])->name('api.urinalysis.destroy');
                // Urinalysis DATATABLE API route
                Route::get('/all', [UrinalysisApi::class, 'tableApi'])->name('api.urinalysis.table');
                // Urinalysis import from a CSV file
                Route::post('/import', [UrinalysisApi::class, 'import'])->name('api.urinalysis.import');
            });
        });
    });

    // Routes for the more pages section of the application.
    Route::prefix('more')->middleware('macm')->group(function () {
        // Summary page for all the pages in the more section.
        Route::get('/', function () {
            return Inertia::render('MorePages/MorePageIndex',[
                'collegesCount' => College::count(),
                'departmentsCount' => Department::count(),
                'programsCount' => DegreeProgram::count(),
                'servicesCount' => Services::count(),
            ]);
        })->name('more.pages');
        // Routes to manage colleges in the university.
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
        // Routes to manage departments in the university.
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
        // Routes to manage the degree programs in the university.
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
        // Routes to manage services offered by the hospital.
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
