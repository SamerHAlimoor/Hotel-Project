<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{
    //

     //
     //
    // index page
    public function allholidays()
    {
        $holidays = Holiday::all();
        return view('employee.holidays', compact('holidays'));
    }
    // add room page
    public function addholiday()
    {
    
        return view('employee.add-holidays');
    }
    // edit room
    public function editholiday($id)
    {
        $holiday = Holiday::findOrFail($id);      
          
        return view('employee.edit-holidays', compact('holiday'));
    }

    // save Staff
    public function saveRecordholiday(Request $request)
    {
        //return $request;
        $request->validate([
            'title'          => 'required',
            'date'     => 'required|date|date_format:d/m/Y',
            'numberofholidays'     => 'required|integer',
           

        ]);
      //  $dt= Carbon::parse($request->date)->timestamp;


     //  return $dt;
  

        DB::beginTransaction();
        try {

            $holiday = new Holiday();
            $holiday->title = $request->title;
            $holiday->date    =  $request->date;
            $holiday->numberofholidays    = $request->numberofholidays;
            $holiday->save();
           DB::commit();
            Toastr::success('We Saved Holiday successfully :)', 'Success');
            return redirect()->route('form.allHoliday.page');
} catch (\Exception $e) {
             return $e;
            DB::rollback();
            Toastr::error('Sorry Try again :' . $e . ')', 'Error');
            return redirect()->back();
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
