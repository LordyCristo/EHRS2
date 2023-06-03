<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class PaymentApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return new PaymentCollection(Payment::select('payments.id', 'payments.or_no', 'payments.payor_name', 'payments.payor_email', 'payments.payor_mobile', 'payments.client_id', 'payments.collector_id', 'payments.total_amount', 'payments.remarks')
//            ->join('clients', 'clients.id', '=', 'payments.client_id')->get());
        $payments = Payment::with('paidServices')->get();
        $exportData = [];

        foreach ($payments as $payment) {
            $services = [];
            $fees = [];

            foreach ($payment->paidServices as $paidService) {
                $services[] = $paidService->fee->service;
                $fees[] = $paidService->fee;
            }

            $exportData[] = [
                'id' => $payment->id,
                'collector_id' => $payment->collector_id,
                'or_no' => $payment->or_no,
                'payor_name' => $payment->payor_name,
                'payor_email' => $payment->payor_email,
                'payor_mobile' => $payment->payor_mobile,
                'infirmary_id' => $payment->client->name,
                'services' => implode(', ', $services),
                'fees' => implode(', ', $fees),
                'total_amount' => $payment->total_amount,
                'remarks' => $payment->remarks,
                'created_at' => $payment->created_at,
                'updated_at' => $payment->updated_at,
            ];
        }
        return new PaymentResource($exportData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        if(!empty($request['rows'])){
            $newPayment = Payment::create($request->all());
            if ($newPayment) {
                $rows = $request['rows'];
                // Save rows in payments_services table
                foreach ($rows as $row) {
                    $newPayment->paidServices()->create([
                        'service_id' => $row['service_id'],
                        'payment_id' => $newPayment->id,
                        'fee' => $row['fee'],
                    ]);
                }
            }
            return response()->json([
                'data' => (new PaymentResource($newPayment)),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => $newPayment?'Successfully created Payment with id '.$newPayment->id:'Failed to create Payment record',
                    'data' => $newPayment,
                ]
            ])->setStatusCode(201);
        }
        return response()->json([
            'data' => null,
            'errors' => ['rows' => 'No rows to save.'],
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to create transaction record',
                'data' => $request->all(),
            ]
        ])->setStatusCode(422);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return new PaymentResource(Payment::findOrFail($request->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request)
    {
        $payment = Payment::findOrFail($request->id);

        if ($payment->update($request->all())) {
            if (!empty($request['rows'])) {
                // Delete existing payment services
                $payment->paidServices()->delete();

                // Save new payment services
                $rows = $request['rows'];
                foreach ($rows as $row) {
                    $payment->paidServices()->create([
                        'service_id' => $row['service_id'],
                        'payment_id' => $payment->id,
                        'fee' => $row['fee'],
                    ]);
                }
            }

            return response()->json([
                'data' => (new PaymentResource($payment)),
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully updated Payment with id ' . $payment->id,
                    'data' => $payment,
                ]
            ])->setStatusCode(200);
        }

        return response()->json([
            'data' => null,
            'errors' => ['payment' => 'Failed to update Payment record'],
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => 'failed',
                'message' => 'Failed to update Payment record',
                'data' => $payment,
            ]
        ])->setStatusCode(422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        $temp = Payment::destroy($id);
        return response()->json([
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => $temp?'success':'failed',
                'message' => $temp?'Successfully deleted '.$temp.' Payment record/s':'Failed to delete Payment record with id '. $request->id,
            ]
        ]);
    }

    /**
     * Get all the fees to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = Payment::join('clients', 'clients.infirmary_id', '=', 'payments.infirmary_id')
            ->join('payments_service', 'payments_service.payment_id', '=', 'payments.id')
            ->selectRaw('payments.or_no, payments.id, payments.payor_name, payments.infirmary_id, COUNT(payments_service.service_id) as services_count, payments.total_amount, payments.remarks')
            ->groupBy('payments.or_no');

        $totalRecords = $query->count();
        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('id', 'like', '%' . $search . '%')
                        ->orWhere('payor_name', 'like', '%' . $search . '%')
                        ->orWhere('payor_email', 'like', '%' . $search . '%')
                        ->orWhere('payor_mobile', 'like', '%' . $search . '%');
                } else {
                    $q->where('payments.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'id');
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

    /**
     * Import the departments from the csv file.
     */
    public function import(Request $request): JsonResponse
    {
        $data = $request->all();
        $successCount = 0;
        $failedCount = 0;
        $response = [
            'successCount' => 0,
            'failedCount' => null,
            'data' => [],
        ];

        $validator = new PaymentRequest();

        foreach ($data as $row) {
            $validation = Validator::make($row, $validator->rules());

            if ($validation->fails()) {
                $failedCount++;
                $row['errors'] = $validation->errors();
                $response['data'][] = $row;
            } else {
                try {
                    Payment::create($row);
                    $successCount++;
                } catch (Exception $e) {
                    $failedCount++;
                    throw $e;
                }
            }
        }

        $response['successCount'] = $successCount;
        $response['failedCount'] = $failedCount;
        return response()->json([
            $response,
            'notification' => [
                'id' => uniqid(),
                'show' => true,
                'type' => !$failedCount?'success':'warning',
                'message' => !$failedCount?'Successfully imported Payments without errors':'Failed to import Payments '.$failedCount.' rows out of '.$failedCount+$successCount,
            ]
        ]);
    }
}
