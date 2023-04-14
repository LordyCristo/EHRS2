<?php

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

    Route::prefix('patients')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Patient/PatientsDashboard');
        })->name('patients');

        Route::get('/new', function () {
            return Inertia::render('Patient/NewPatient');
        })->name('newPatient');

        Route::get('/edit', function () {
            return Inertia::render('Patient/EditPatient');
        })->name('editPatient');
    });

    Route::get('/medicalRecords', function () {
        return Inertia::render('MedicalRecords');
    })->name('records');

    Route::get('/radiology', function () {
        return Inertia::render('Radiology');
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
});
