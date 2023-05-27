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

class PaymentApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PaymentCollection(Payment::select('payments.id', 'payments.or_no', 'payments.payor_name', 'payments.payor_email', 'payments.payor_mobile', 'payments.client_id', 'payments.collector_id', 'payments.total_amount', 'payments.remarks')
            ->join('clients', 'clients.id', '=', 'payments.client_id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $newPayment = Payment::create($request->all());
        return (new PaymentResource($newPayment))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request)
    {
        $payment = Payment::findOrFail($request->id);
        $update = $payment->update($request->all());
        if ($update)
            return response(null, 202);
        return response(null, 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = explode(',', $request->id);
        Payment::destroy($id);
        // return the success code
        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully'
        ]);
    }

    /**
     * Get all the fees to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = Payment::join('clients', 'clients.id', '=', 'payments.client_id')
            ->join('payments_service', 'payments_service.payment_id', '=', 'payments.id')
            ->join('services', 'services.id', '=', 'payments_service.service_id')
            ->select('payments.id', 'payments.or_no', 'payments.payor_name', 'payments.payor_email', 'payments.payor_mobile', 'payments.client_id', 'services.name as service_id', 'payments.collector_id', 'payments.total_amount', 'payments.remarks');

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
        return response()->json($response);
    }
}
