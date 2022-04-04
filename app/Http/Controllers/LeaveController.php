<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    //
     //
    // index page
    public function allLeaves()
    {
        $leaves = Leave::all();
       // $leaves = DB::table('leaves')->get();
        
       // return $leaves;
        return view('employee.leaves', compact('leaves'));
    }
    // add room page
    public function addLeave()
    {
       // $data = DB::table('staffs')->get();
        //  $user = DB::table('users')->get();
        return view('employee.add-leaves');
    }
    // edit room
    public function editLeave($id)
    {
        $leave = Leave::findOrFail($id);      
        $img = "/assets/upload/". $leave->fileupload;       
        return view('employee.edit-leaves', compact('leave','img'));
    }

    // save Staff
    public function saveRecordLeave(Request $request)
    {
        //return $request;
        $request->validate([
            'leave_type'          => 'required',
            'from'     => 'required|string|date_format:d/m/Y',
            'to'     => 'required|string|date_format:d/m/Y',
            'leave_reason'=> 'required',

        ]);

      //  return $request;

        DB::beginTransaction();
        try {

            $photo = $request->fileupload;
            $file_name = rand() . '.' . $photo->getClientOriginalName();
            $photo->move(public_path('/assets/upload/'), $file_name);
            ////////////////// calc date 
            $to = Carbon::createFromFormat('d/m/Y', $request->to);
            $from = Carbon::createFromFormat('d/m/Y', $request->from);
            $diff_in_days = $to->diffInDays($from);
              ////////////////// End calc date 
            $leave = new Leave();
            $leave->leave_type = $request->leave_type;
            $leave->from    = $request->from;
            $leave->to    = $request->to;
            $leave->leave_reason   = $request->leave_reason;
            $leave->numberofdays   = $diff_in_days;
            $leave->status      = "0";
            $leave->fileupload   = $file_name;
          //  $id = Auth::id();
            $leave->emp_id    = 1;
          // return $leave;
            $leave->save();
           DB::commit();
            Toastr::success('We Sent Your Request successfully :)', 'Success');
            return redirect()->route('form.allleave.page');
} catch (\Exception $e) {
             return $e;
            DB::rollback();
            Toastr::error('Sorry Your Request is bad :' . $e . ')', 'Error');
            return redirect()->back();
        }
    }

    // update record
    public function updateRecord(Request $request)
    {
       
        try {
            DB::beginTransaction();
          // $leave = Leave::findOrFail($request->id);
            $leave = Leave::where('id', $request->id)->update(array('status' => $request->status));
            DB::commit();
            Toastr::success('Updated Leave successfully :)', 'Success');
            return redirect()->route('form.allleave.page');
        } catch (\Exception $e) {
           // return  $e;
            DB::rollback();
            Toastr::error('Update Leave fail :)', 'Error');
            return redirect()->back();
        
        }

    }

    // delete record
    public function deleteRecord(Request $request)
    {
        try {
            DB::beginTransaction();
            $leave=  Leave::find($request->id);
            $path = public_path()."/assets/upload/". $leave->fileupload;
            unlink($path);
            $leave->delete();
            DB::commit();
            Toastr::success('Leave deleted successfully :)','Success');
            return redirect()->back();
        } catch (\Exception $e) {
      return $e;
            DB::rollback();
            Toastr::error('Leave delete fail :)', 'Error');
            return redirect()->back();
        }
    }
}
