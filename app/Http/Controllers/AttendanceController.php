<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    //

     //
     //
    // index page
    public function allattendance()
    {
       // $attendances = Attendance::all();
        $employees = Employee::all();
      //  return $employees;
        return view('employee.attendance', compact('employees'));
    }
    // add room page
    public function addattendance()
    {
        $employees = Employee::all();

        return view('employee.add-attendance', compact('employees'));
    }
    // edit room
    public function editattendance($id)
    {
        //$holiday = Holiday::findOrFail($id);      
          
        return view('employee.edit-holidays', compact('holiday'));
    }

    // save Staff
    public function saveRecordattendance(Request $request)
    {
       // return $request;
       try {

        foreach ($request->attendences as $employee_id => $attendence) {

            if( $attendence == '0' ) {
                $attendence_status = true;
            } else if( $attendence == '1' ){
                $attendence_status = false;
            }

        //    return $attendence_status;

            Attendance::create([
                'employee_id'=> $employee_id,
                'attendence_date'=> date('Y-m-d'),
                'attendence_status'=> $attendence_status
            ]);

        }

        toastr()->success('Updated Attendance successfully');
        return redirect()->route('form.Attendance.all');

    }

    catch (\Exception $e){
        //return $e;
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    // update record
    public function updateRecord(Request $request)
    {
        //return $request;
       
        try {
            DB::beginTransaction();
          // $leave = Leave::findOrFail($request->id);
          $request->validate([
            'title'          => 'required',
            'date'     => 'required|date|date_format:d/m/Y',
            'numberofholidays'     => 'required|integer',
            'status'     => 'required',
           

        ]);

        $update = [
            'title' => $request->title,
            'date'   => $request->date,
            'numberofholidays'  => $request->numberofholidays,
            'status' => $request->status,
        ];

            $holiday = Holiday::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Updated Leave successfully :)', 'Success');
            return redirect()->route('form.allHoliday.page');
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
            $holiday=  Holiday::find($request->id);
            $holiday->delete();
            DB::commit();
            Toastr::success('Holiday deleted successfully :)','Success');
            return redirect()->back();
        } catch (\Exception $e) {
      return $e;
            DB::rollback();
            Toastr::error('Holiday delete fail :)', 'Error');
            return redirect()->back();
        }
    }
}
