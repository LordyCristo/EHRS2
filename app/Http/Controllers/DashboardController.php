<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicalRecordResource;
use App\Models\College;
use App\Models\Dental;
use App\Models\DentalRecord;
use App\Models\FecalysisRecord;
use App\Models\HematologyRecord;
use App\Models\PaymentsService;
use App\Models\Services;
use App\Models\UrinalysisRecord;
use App\Models\Xray;
use App\Models\XrayRequest;
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
                    'records_count' => Xray::whereNotNull('rqst_id')->count(),
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

    public function summary(){
        $hematology = HematologyRecord::count();
        $fecalysis = FecalysisRecord::count();
        $urinalysis = UrinalysisRecord::count();
        $radiology = Xray::count();
        $dental = DentalRecord::count();

        return response()->json([
            ['Service', 'Number of Records'],
            ['Hematology', $hematology],
            ['Fecalysis', $fecalysis],
            ['Urinalysis', $urinalysis],
            ['Radiology', $radiology],
            ['Dental', $dental],
        ]);
    }

    public function monthly()
    {
        $records = [
            'Hematology' => HematologyRecord::class,
            'Fecalysis' => FecalysisRecord::class,
            'Urinalysis' => UrinalysisRecord::class,
            'Radiology' => Xray::class,
            'Dental' => DentalRecord::class,
        ];

        $monthlyCounts = [];

        foreach ($records as $recordName => $recordClass) {
            $monthlyCounts[$recordName] = $recordClass::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(id) as count')
            )
                ->groupBy('month')
                ->get()
                ->keyBy('month') // Use keyBy instead of pluck
                ->map(function ($record) {
                    return $record->count;
                })
                ->toArray();
        }

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December',
        ];

        $data = [['Month', ...array_keys($records)]];

        foreach ($months as $month) {
            $row = [$month];

            foreach ($records as $recordName => $recordClass) {
                $count = $monthlyCounts[$recordName][$month] ?? 0;
                $row[] = $count;
            }

            $data[] = $row;
        }

        return response()->json($data);
    }

    public function byCollege(Request $request)
    {
        $hematology = $this->getRecordsCount($request->getByTable, $request->getByColumn, $request->getGroupBy,'hematology_records');
        $fecalysis = $this->getRecordsCount($request->getByTable, $request->getByColumn, $request->getGroupBy, 'fecalysis_records');
        $urinalysis = $this->getRecordsCount($request->getByTable, $request->getByColumn, $request->getGroupBy, 'urinalysis_records');
        $radiology = $this->getRecordsCount($request->getByTable, $request->getByColumn, $request->getGroupBy, 'xray_requests');
        $labels = $hematology->pluck('abbr')->toArray();
        if($request->getGroupBy === 'sex'){
            $labels = ['Male','Female'];
        } elseif ($request->getGroupBy === 'civil_status'){
            $labels = ['Single','Married','Widowed','Separated'];
        } elseif ($request->getGroupBy === 'year_lvl'){
            $labels = ['1st Year','2nd Year','3rd Year','4th Year','5th Year','6th Year'];
        } elseif ($request->getGroupBy === 'age'){
            $labels = ['Below 18','18-25','26-35','36-45','46-55','56-65','Above 65'];
        }
        return response()->json([
            'params' => [
                $request->all()
            ],
            'hematology' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Hematology',
                        'color' => '#F44336',
                        'data' => $hematology->pluck('count')->toArray(),
                    ],
                ],
            ],
            'fecalysis' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Fecalysis',
                        'color' => '#2196F3',
                        'data' => $fecalysis->pluck('count')->toArray(),
                    ],
                ],
            ],
            'urinalysis' => [
                'labels' =>$labels,
                'datasets' => [
                    [
                        'label' => 'Urinalysis',
                        'color' => '#4CAF50',
                        'data' => $urinalysis->pluck('count')->toArray(),
                    ],
                ],
            ],
            'radiology' => [
                'labels' => $labels,
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

    private function getRecordsCount($getBy, $getByColumn, $getGroupBy, $serviceTable)
    {
        // set default value for $getByColumn
        if (empty($getByColumn))
            $getByColumn = '*';
        if(empty($getGroupBy))
            $getGroupBy = 'clients.sex';
        if ($getBy === 'colleges')
            return College::leftJoin('departments', 'colleges.id', '=', 'departments.college_id')
                ->leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                ->leftJoin($serviceTable, 'clients.infirmary_id', '=', $serviceTable.'.infirmary_id')
                ->select($getGroupBy, DB::raw('COUNT('.$serviceTable.'.id) as count'))
                ->groupBy('clients.'.$getGroupBy)
                ->having('count', '>', 0)
                ->orderBy($getGroupBy)
                ->get();
        else if ($getBy === 'departments')
            return Department::leftJoin('degree_programs', 'departments.id', '=', 'degree_programs.department_id')
                ->leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                ->leftJoin($serviceTable, 'clients.infirmary_id', '=', $serviceTable.'.infirmary_id')
                ->select('departments.name', 'departments.abbr', DB::raw('COUNT('.$serviceTable.'.id) as count'))
                ->groupBy('departments.abbr')
                ->having('count', '>', 0)
                ->orderBy('departments.abbr')
                ->get();
        else{
            if($getByColumn === '*')
                return DegreeProgram::leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                    ->leftJoin($serviceTable, 'clients.infirmary_id', '=', $serviceTable . '.infirmary_id')
                    ->select('degree_programs.name', 'degree_programs.abbr', DB::raw('COUNT(' . $serviceTable . '.id) as count'))
                    ->groupBy('clients.sex', 'degree_programs.abbr')
                    ->having('count', '>', 0)
                    ->orderBy('degree_programs.abbr')
                    ->get();
            else
                return DegreeProgram::leftJoin('clients', 'degree_programs.id', '=', 'clients.program_id')
                    ->leftJoin($serviceTable, 'clients.infirmary_id', '=', $serviceTable . '.infirmary_id')
                    ->select('degree_programs.name', 'degree_programs.abbr', DB::raw('COUNT(' . $serviceTable . '.id) as count'))
                    ->groupBy($getGroupBy, 'degree_programs.abbr')
                    ->where('clients.year_lvl', $getByColumn)
                    ->having('count', '>', 0)
                    ->orderBy('degree_programs.abbr')
                    ->get();
        }
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
