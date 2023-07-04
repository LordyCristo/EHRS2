<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhysicalExamRequest;
use App\Http\Resources\PhysicalExamCollection;
use App\Models\Client;
use App\Models\PhysicalExam;
use App\Models\PhysicalExamAttachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PhysicalExamApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PhysicalExamCollection(PhysicalExam::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PhysicalExamRequest $request)
    {
        $record = Client::where('infirmary_id', $request->infirmary_id)->first();
        if ($request->type === 'student') {
            $record = $record->physicalExam->create($request->validated());
        } elseif ($request->type === 'outpatient') {
            foreach ($request->rows as $row){
                $record->physicalExam->create($row);
            }
        }
//        elseif ($request->type === 'er') {
//            $record = PhysicalExam::create($request->validated());
//        }

        foreach ($request->attachments as $attachment){
            $record->attachments()->create([
                'image' => $attachment['image'],
            ]);
        }
        if ($record){
            return response()->json([
                'data' => $record,
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully created Physical Exam with id '.$record->id,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => $record,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to create Physical Exam',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhysicalExamRequest $request)
    {
        $record = PhysicalExam::findOrFail($request->id);
        $record->update($request->all());
        foreach ($request->attachments as $attachment){
            //delete old attachments
            $oldAttachments = PhysicalExamAttachment::where('physical_exam_id', $record->id)->whereNotIn('image', $request->attachments)->get();
            foreach ($oldAttachments as $oldAttachment){
                $oldAttachment->delete();
            }
            //update or create new attachments
            $record->attachments()->updateOrCreate([
                'physical_exam_id' => $record->id,
                'image' => $attachment,
            ]);
        }
        // if no attachments are passed, delete all attachments
        if (count($request->attachments) == 0){
            $oldAttachments = PhysicalExamAttachment::where('physical_exam_id', $record->id)->get();
            foreach ($oldAttachments as $oldAttachment){
                $oldAttachment->delete();
            }
        }
        if ($record){
            return response()->json([
                'data' => $record,
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully updated Physical Exam with id '.$record->id,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => $record,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to update Physical Exam',
            ]
        ])->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $record = PhysicalExam::findOrFail($request->id);
        $record->delete();
        if ($record){
            return response()->json([
                'data' => $record,
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully deleted Physical Exam with id '.$record->id,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => $record,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to delete Physical Exam',
            ]
        ])->setStatusCode(201);
    }

    public function tableApi(Request $request): JsonResponse
    {
        $query = PhysicalExam::join('clients', 'physical_exams.infirmary_id', '=', 'clients.infirmary_id')
            ->selectRaw('physical_exams.id, clients.infirmary_id, CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) as name');
        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'infirmary_id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('physical_exams.id', 'like', '%' . $search . '%')
                        ->orwhere('physical_exams.infirmary_id', 'like', '%' . $search . '%')
                        ->orWhereRaw('CONCAT(clients.last_name, ", ", clients.first_name, IFNULL(CONCAT(clients.middle_name, " "), ""), IFNULL(clients.suffix, "")) LIKE ?', '%' . $search . '%');
                } elseif ($searchBy == 'name'){
                    $q->where('clients.last_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.first_name', 'like', '%' . $search . '%')
                        ->orWhere('clients.middle_name', 'like', '%' . $search . '%');
                } else {
                    $q->where('physical_exams.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'physical_exams.id');
        $sortDirection = $request->input('sort_dir', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $paginator->items(),
            'totalCount' => $paginator->total(),
            'totalPages' => $paginator->lastPage(),
            'perPage' => $paginator->perPage(),
            'totalRecords' => $totalRecords,
        ]);
    }

}
