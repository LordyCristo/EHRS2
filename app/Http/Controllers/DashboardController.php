<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Dental;
use App\Models\DentalRecord;
use App\Models\FecalysisRecord;
use App\Models\HematologyRecord;
use App\Models\PaymentsService;
use App\Models\UrinalysisRecord;
use App\Models\Xray;
use Carbon\Carbon;
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
        $startOfSemester = Carbon::create(Carbon::now()->year, 8, 1, 0, 0, 0);
        $endOfSemester = Carbon::create(Carbon::now()->year, 6, 30, 0, 0, 0);
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
                    'daily_records_count' => HematologyRecord::whereDate('created_at', Carbon::today())->count(),
                    'weekly_records_count' => HematologyRecord::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
                    'monthly_records_count' => HematologyRecord::whereMonth('created_at', Carbon::now()->month)->count(),
                    'semester_records_count' => HematologyRecord::whereBetween('created_at', [$startOfSemester, $endOfSemester])->count(),
                    'annually_records_count' => HematologyRecord::whereYear('created_at', Carbon::now()->year)->count(),
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
                'radiology' => [
                    'title' => 'Radiology Report',
                    'description' => 'Number of radiology records per Program, Department, and College',
                    'records_count' => Xray::all()->count(),
                    'records_count_per_department' => Department::leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('xray_requests', 'clients.infirmary_id', '=', 'xray_requests.infirmary_id')
                        ->select('departments.name', 'departments.abbr', DB::raw('COUNT(xray_requests.id) as count'))
                        ->groupBy('departments.abbr')
                        ->orderBy('departments.abbr')
                        ->get(),
                    'records_count_per_program' => DegreeProgram::leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('xray_requests', 'clients.infirmary_id', '=', 'xray_requests.infirmary_id')
                        ->select('degree_programs.name', 'degree_programs.abbr', DB::raw('COUNT(xray_requests.id) as count'))
                        ->groupBy('degree_programs.abbr')
                        ->orderBy('degree_programs.abbr')
                        ->get(),
                    'records_count_per_college' => College::leftJoin('departments', 'colleges.id', '=', 'departments.college_id')
                        ->leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('xray_requests', 'clients.infirmary_id', '=', 'xray_requests.infirmary_id')
                        ->select('colleges.name', 'colleges.abbr', DB::raw('COUNT(xray_requests.id) as count'))
                        ->groupBy('colleges.abbr')
                        ->orderBy('colleges.abbr')
                        ->get(),
                    'total_revenue' => PaymentsService::selectRaw('SUM(fee) as total_revenue')->where('service_id',6)->get(),
                ],
                'dental' => [
                    'title' => 'Dental Report',
                    'description' => 'Number of dental records per Program, Department, and College',
                    'records_count' => DentalRecord::all()->count(),
                    'records_count_per_department' => Department::leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('dental_records', 'clients.infirmary_id', '=', 'dental_records.infirmary_id')
                        ->select('departments.name', 'departments.abbr', DB::raw('COUNT(dental_records.id) as count'))
                        ->groupBy('departments.abbr')
                        ->orderBy('departments.abbr')
                        ->get(),
                    'records_count_per_program' => DegreeProgram::leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('dental_records', 'clients.infirmary_id', '=', 'dental_records.infirmary_id')
                        ->select('degree_programs.name', 'degree_programs.abbr', DB::raw('COUNT(dental_records.id) as count'))
                        ->groupBy('degree_programs.abbr')
                        ->orderBy('degree_programs.abbr')
                        ->get(),
                    'records_count_per_college' => College::leftJoin('departments', 'colleges.id', '=', 'departments.college_id')
                        ->leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                        ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                        ->leftJoin('dental_records', 'clients.infirmary_id', '=', 'dental_records.infirmary_id')
                        ->select('colleges.name', 'colleges.abbr', DB::raw('COUNT(dental_records.id) as count'))
                        ->groupBy('colleges.abbr')
                        ->orderBy('colleges.abbr')
                        ->get(),
                    'total_revenue' => PaymentsService::selectRaw('SUM(fee) as total_revenue')->where('service_id',6)->get(),
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


    public function byCollege(Request $request)
    {
        $hematology = $this->getRecordsCountByService($request->getBy,'hematology_records');
        $fecalysis = $this->getRecordsCountByService($request->getBy,'fecalysis_records');
        $urinalysis = $this->getRecordsCountByService($request->getBy,'urinalysis_records');
        $radiology = $this->getRecordsCountByService($request->getBy,'xray_requests');

        return response()->json([
            'params' => [
                $request->all()
            ],
            'hematology' => [
                'labels' => $hematology->pluck('abbr')->toArray(),
                'datasets' => [
                    [
                        'label' => 'Hematology',
                        'color' => '#F44336',
                        'data' => $hematology->pluck('count')->toArray(),
                    ],
                ],
            ],
            'fecalysis' => [
                'labels' => $fecalysis->pluck('abbr')->toArray(),
                'datasets' => [
                    [
                        'label' => 'Fecalysis',
                        'color' => '#2196F3',
                        'data' => $fecalysis->pluck('count')->toArray(),
                    ],
                ],
            ],
            'urinalysis' => [
                'labels' => $urinalysis->pluck('abbr')->toArray(),
                'datasets' => [
                    [
                        'label' => 'Urinalysis',
                        'color' => '#4CAF50',
                        'data' => $urinalysis->pluck('count')->toArray(),
                    ],
                ],
            ],
            'radiology' => [
                'labels' => $urinalysis->pluck('abbr')->toArray(),
                'datasets' => [
                    [
                        'label' => 'Radiology',
                        'color' => '#55EB3B',
                        'data' => $radiology->pluck('count')->toArray(),
                    ],
                ],
            ],
        ]);
    }

    private function getRecordsCountByService($getBy, $serviceTable)
    {
        if ($getBy === 'colleges')
            return College::leftJoin('departments', 'colleges.id', '=', 'departments.college_id')
                ->leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                ->leftJoin($serviceTable, 'clients.infirmary_id', '=', $serviceTable.'.infirmary_id')
                ->select('colleges.name', 'colleges.abbr', DB::raw('COUNT('.$serviceTable.'.id) as count'))
                ->groupBy('colleges.abbr')
                ->orderBy('colleges.abbr')
                ->get();
        else if ($getBy === 'departments')
            return Department::leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                ->leftJoin($serviceTable, 'clients.infirmary_id', '=', $serviceTable.'.infirmary_id')
                ->select('departments.name', 'departments.abbr', DB::raw('COUNT('.$serviceTable.'.id) as count'))
                ->groupBy('departments.abbr')
                ->orderBy('departments.abbr')
                ->get();
        else if ($getBy === 'degree_programs')
            return DegreeProgram::leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                ->leftJoin($serviceTable, 'clients.infirmary_id', '=', $serviceTable.'.infirmary_id')
                ->select('degree_programs.name', 'degree_programs.abbr', DB::raw('COUNT('.$serviceTable.'.id) as count'))
                ->groupBy('degree_programs.abbr')
                ->orderBy('degree_programs.abbr')
                ->get();
        else
            return Client::leftJoin($serviceTable, 'clients.infirmary_id', '=', $serviceTable.'.infirmary_id')
                ->selectRaw('COUNT(clients.id) as count, clients.sex as name, clients.sex as abbr')
                ->groupBy('clients.sex')
                ->get();
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
