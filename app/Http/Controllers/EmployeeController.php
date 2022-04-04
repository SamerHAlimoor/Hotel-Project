<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class EmployeeController extends Controller
{
    //

    //
    // index page
    public function allEmployee()
    {
        $allEmployee = DB::table('employees')->get();
        return view('employee.employee', compact('allEmployee'));
    }
    // add room page
    public function addEmployee()
    {
        $data = DB::table('employees')->get();
        //  $user = DB::table('users')->get();
        return view('employee.add-employee', compact('data'));
    }
    // edit room
    public function editEmployee($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        return $employee;
        $data = DB::table('employees')->get();
        // $user = DB::table('staffs')->get();
        return view('employee.employee', compact('user', 'data', 'roomEdit'));
    }

    // save Staff
    public function saveRecordEmployee(Request $request)
    {
        // return $request;

        $request->validate([
            'first_name'          => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'username'     => 'required|unique:employees|max:255',
            'email'          => 'required|unique:employees|max:255',
            'password'     => 'required|string|max:255',
            'joining_date'  => 'required|string|max:255',
            'leaving_time'  => 'required|string|max:255',
            'ph_number'          => 'required|integer',
            'onDuty'  => 'required|string|max:255',
            'role'    => 'required|integer|max:12',
            'status'    => 'required|integer|max:12',
            'fileupload'    => 'required|file',

        ]);

       // return $request;

        DB::beginTransaction();
        try {

            $photo = $request->fileupload;
            $file_name = rand() . '.' . $photo->getClientOriginalName();
            $photo->move(public_path('/assets/upload/'), $file_name);

            $staff = new Employee();
            $staff->first_name         = $request->first_name;
            $staff->last_name    = $request->last_name;
            $staff->username    = $request->username;
            $staff->email         = $request->email;
            $staff->password    = $request->password;
            $staff->joining_date = $request->joining_date;
            $staff->leaving_time      = $request->leaving_time;
            $staff->ph_number         = $request->ph_number;
            $staff->onDuty      = $request->onDuty;
            $staff->role      = $request->role;
            $staff->status      = $request->status;
            $staff->fileupload   = $file_name;
            
          
            
            
            // return $request;
            $staff->save();

           DB::commit();
            Toastr::success('Create new room successfully :)', 'Success');
            return redirect()->route('form.allemployee.page');
} catch (\Exception $e) {
            // return $e;
            DB::rollback();
            Toastr::error('Add Employee fail :' . $e . ')', 'Error');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->fileupload)) {
                $photo = $request->fileupload;
                $file_name = rand() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('/assets/upload/'), $file_name);
            } else {
                $file_name = $request->hidden_fileupload;
            }

            $update = [
                'bkg_room_id' => $request->bkg_room_id,
                'name'   => $request->name,
                'room_type'  => $request->room_type,
                'ac_non_ac'  => $request->ac_non_ac,
                'food'  => $request->food,
                'bed_count'  => $request->bed_count,
                'charges_for_cancellation'  => $request->charges_for_cancellation,
                'phone_number' => $request->phone_number,
                'fileupload' => $file_name,
                'message'   => $request->message,
            ];
            Room::where('bkg_room_id', $request->bkg_room_id)->update($update);

            DB::commit();
            Toastr::success('Updated Employee successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update Employee fail :)', 'Error');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // delete record
    public function deleteRecord(Request $request)
    {
        try {
            DB::beginTransaction();
            $employee=  Employee::find($request->id);
            $path = public_path()."/assets/upload/". $employee->fileupload;
            unlink($path);
            $employee->delete();
            DB::commit();
            Toastr::success('Employee deleted successfully :)','Success');
            return redirect()->back();
        } catch (\Exception $e) {
      return $e;
            DB::rollback();
            Toastr::error('Employee delete fail :)', 'Error');
            return redirect()->back();
        }
    }

}
