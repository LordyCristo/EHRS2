<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApprovalCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ApprovalApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Approval/ApprovalIndex');
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
     * Update the specified resource in storage.
     */
    public function approve(Request $request)
    {
        $approval = DB::table('approvals')->where('id', $request->id)->first();
        if($approval && $approval->state === 'pending'){
            //get the data and create a new user
            $data = json_decode($approval->new_data, true);
            //$model = $approval->approvalable_type;
            //$model->withoutApproval()->create($data);
            $user = User::create($data);
            // Skip approval for certain users
            $user->withoutApproval()->save();
            //delete the approval
            DB::table('approvals')->where('id', $approval->id)->update([
                'state' => 'approved'
            ]);
            return response()->json([
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'Successfully created '.$request->id.' record',
                ]
            ])->setStatusCode(201);
        }
        elseif ($approval && $approval->state === 'approved'){
            return response()->json([
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'success',
                    'message' => 'User id '.$request->id.' has already been approved',
                ]
            ])->setStatusCode(201);
        }
        else{
            return response()->json([
                'notification' => [
                    'id' => uniqid(),
                    'show' => true,
                    'type' => 'warning',
                    'message' => 'Unable to approve user id '.$request->id,
                ]
            ])->setStatusCode(201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function tableApi()
    {
        return DB::table('approvals')->select()->get();
    }
}
