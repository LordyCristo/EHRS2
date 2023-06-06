<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\FecalysisRecord;
use App\Models\HematologyRecord;
use App\Models\PaymentsService;
use App\Models\UrinalysisRecord;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Department;
use App\Models\DegreeProgram;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dashboard',[
            'cards' => [
                'hematology' => [
                    'title' => 'Hematology Report',
                    'description' => 'Number of hematology records per Program, Department, and College',
                    'records_count' => HematologyRecord::all()->count(),
                    'records_count_per_department' => Department::leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('hematology_records', 'clients.infirmary_id', '=', 'hematology_records.infirmary_id')
                        ->select('departments.name', 'departments.abbr', DB::raw('COUNT(hematology_records.id) as count'))
                        ->groupBy('departments.abbr')
                        ->orderBy('departments.abbr')
                        ->get(),
                    'records_count_per_program' => DegreeProgram::leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('hematology_records', 'clients.infirmary_id', '=', 'hematology_records.infirmary_id')
                        ->select('degree_programs.name', 'degree_programs.abbr', DB::raw('COUNT(hematology_records.id) as count'))
                        ->groupBy('degree_programs.abbr')
                        ->orderBy('degree_programs.abbr')
                        ->get(),
                    'records_count_per_college' => College::leftJoin('departments', 'colleges.id', '=', 'departments.college_id')
                        ->leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('hematology_records', 'clients.infirmary_id', '=', 'hematology_records.infirmary_id')
                        ->select('colleges.name', 'colleges.abbr', DB::raw('COUNT(hematology_records.id) as count'))
                        ->groupBy('colleges.abbr')
                        ->orderBy('colleges.abbr')
                        ->get(),
                    'total_revenue' => PaymentsService::selectRaw('SUM(fee) as total_revenue')->where('service_id',3)->get(),
                ],
                'fecalysis' => [
                    'title' => 'Fecalysis Report',
                    'description' => 'Number of fecalysis records per Program, Department, and College',
                    'records_count' => FecalysisRecord::all()->count(),
                    'records_count_per_department' => Department::leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('fecalysis_records', 'clients.infirmary_id', '=', 'fecalysis_records.infirmary_id')
                        ->select('departments.name', 'departments.abbr', DB::raw('COUNT(fecalysis_records.id) as count'))
                        ->groupBy('departments.abbr')
                        ->orderBy('departments.abbr')
                        ->get(),
                    'records_count_per_program' => DegreeProgram::leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('fecalysis_records', 'clients.infirmary_id', '=', 'fecalysis_records.infirmary_id')
                        ->select('degree_programs.name', 'degree_programs.abbr', DB::raw('COUNT(fecalysis_records.id) as count'))
                        ->groupBy('degree_programs.abbr')
                        ->orderBy('degree_programs.abbr')
                        ->get(),
                    'records_count_per_college' => College::leftJoin('departments', 'colleges.id', '=', 'departments.college_id')
                        ->leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('fecalysis_records', 'clients.infirmary_id', '=', 'fecalysis_records.infirmary_id')
                        ->select('colleges.name', 'colleges.abbr', DB::raw('COUNT(fecalysis_records.id) as count'))
                        ->groupBy('colleges.abbr')
                        ->orderBy('colleges.abbr')
                        ->get(),
                    'total_revenue' => PaymentsService::selectRaw('SUM(fee) as total_revenue')->where('service_id',4)->get(),
                ],
                'urinalysis' => [
                    'title' => 'Urinalysis Report',
                    'description' => 'Number of urinalysis records per Program, Department, and College',
                    'records_count' => UrinalysisRecord::all()->count(),
                    'records_count_per_department' => Department::leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('urinalysis_records', 'clients.infirmary_id', '=', 'urinalysis_records.infirmary_id')
                        ->select('departments.name', 'departments.abbr', DB::raw('COUNT(urinalysis_records.id) as count'))
                        ->groupBy('departments.abbr')
                        ->orderBy('departments.abbr')
                        ->get(),
                    'records_count_per_program' => DegreeProgram::leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('urinalysis_records', 'clients.infirmary_id', '=', 'urinalysis_records.infirmary_id')
                        ->select('degree_programs.name', 'degree_programs.abbr', DB::raw('COUNT(urinalysis_records.id) as count'))
                        ->groupBy('degree_programs.abbr')
                        ->orderBy('degree_programs.abbr')
                        ->get(),
                    'records_count_per_college' => College::leftJoin('departments', 'colleges.id', '=', 'departments.college_id')
                        ->leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('urinalysis_records', 'clients.infirmary_id', '=', 'urinalysis_records.infirmary_id')
                        ->select('colleges.name', 'colleges.abbr', DB::raw('COUNT(urinalysis_records.id) as count'))
                        ->groupBy('colleges.abbr')
                        ->orderBy('colleges.abbr')
                        ->get(),
                    'total_revenue' => PaymentsService::selectRaw('SUM(fee) as total_revenue')->where('service_id',5)->get(),
                ],
            ],
            'charts' => [
                'groupBy_sex' => DB::table('clients')
                    ->select('sex', DB::raw('COUNT(id) as count'))
                    ->groupBy('sex')
                    ->get(),
            ]
        ]);
    }

    /**
     * Get the data for the dashboard summary report.
     */
    public function dataSummary(){
        return response()->json([
            'cards' => [
                'total_records' => ['Number of Records',Client::all()->count()],
                'total_departments' => ['Number of Departments',Department::all()->count()],
                'total_programs' => ['Number of Programs',DegreeProgram::all()->count()],
            ],
            'charts' => [
                'groupBy_sex' => DB::table('clients')
                    ->select('sex', DB::raw('COUNT(id) as count'))
                    ->groupBy('sex')
                    ->get(),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
