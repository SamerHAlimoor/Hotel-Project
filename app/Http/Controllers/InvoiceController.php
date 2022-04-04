<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    //

     //
    // index page
    public function all()
    {
        $all = DB::table('invoices')->get();
        return view('employee.invoice', compact('all'));
    }
    // add room page
    public function addInvoice()
    {
        $data = DB::table('invoices')->get();
        //  $user = DB::table('users')->get();
        return view('employee.add-invoice', compact('data'));
    }
    // edit room
    public function editInvoice($id)
    {
        $roomEdit = DB::table('staffs')->where('staff_id', $id)->first();
        $data = DB::table('staffs')->get();
        // $user = DB::table('staffs')->get();
        return view('staff.edit_staff', compact('user', 'data', 'roomEdit'));
    }

    // save Staff
    public function saveRecordInvoice(Request $request)
    {
        //const $data;
    $array= Array($request->item,$request->description ,$request->unit_cost,$request->qty,$request->amount);
    $key=Array ("item_name", "description", "unit_cost" ,"qty","amount"); 
     $data=   array_combine($key, $array);
      
      $request->request->add(['items' =>$data]);
      return $request->except('item','description','unit_cost','qty','amount');
     

       

        $request->validate([
            'first_name'          => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'username'     => 'required|string|max:255',
            'email'          => 'required|',
            'password'     => 'required|string|max:255',
            'joining_date'  => 'required|string|max:255',
            'leaving_time'  => 'required|string|max:255',
            'ph_number'          => 'required|integer',
            'onDuty'  => 'required|string|max:255',
            'role'    => 'required|integer|max:12',
            'status'    => 'required|integer|max:12',
            'fileupload'    => 'required|file',

        ]);

        //return $request;

        DB::beginTransaction();
        try {

            $photo = $request->fileupload;
            $file_name = rand() . '.' . $photo->getClientOriginalName();
            $photo->move(public_path('/assets/upload/'), $file_name);

            $staff = new Staff();
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
            return redirect()->route('form.allstaff.page');
} catch (\Exception $e) {
            // return $e;
            DB::rollback();
            Toastr::error('Add Staff fail :' . $e . ')', 'Error');
            return redirect()->back();
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
            Toastr::success('Updated room successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update room fail :)', 'Error');
            return redirect()->back();
        }
    }

    // delete record
    public function deleteRecord(Request $request)
    {
        try {

            Room::destroy($request->id);
            unlink('assets/upload/' . $request->fileupload);
            Toastr::success('Room deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Room delete fail :)', 'Error');
            return redirect()->back();
        }
    }
}
