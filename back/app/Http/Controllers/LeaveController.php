<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\SendEmailController;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Leave::all();
    }

    /**
     * Display a listing of the resource with user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLeavesUser()
    {
        return Leave::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leave = new Leave();
        $leave->user_id = $request->user_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->duration = $request->duration;
        $leave->leave_type = $request->leave_type;
        $leave->reason = $request->reason;
        $leave->status = 'Pending';
        $leave->is_review = false;
        $leave->save();

        // Send Mail Request
        $sendMail = (new SendEmailController)->sendMailRequest($request);

        return response()->json(['message'=>'Leave created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leave  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        return $leave;
    }

    /**
     * Display the specified resource with user.
     *
     * @param  \App\Models\Leave  $id
     * @return \Illuminate\Http\Response
     */
    public function getLeaveUser($id)
    {
        return Leave::with('user')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Leave $leave)
    {
        $leave->status = $request->status;
        $leave->save();

        return response()->json(['message'=>'Leave updated successfully']);
    }

    /** Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Leave  $leave
    * @return \Illuminate\Http\Response
    */
    public function updateAsViewed(Request $request, Leave $leave)
    {
        $leave->is_review = true;
        $leave->save();

        return response()->json(['message'=>'Leave updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        return $leave->delete();
    }
}
