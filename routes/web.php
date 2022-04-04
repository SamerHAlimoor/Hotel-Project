<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });
});

Auth::routes();

// -----------------------------home----------------------------------------//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->middleware('auth')->name('profile');

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

// ----------------------------- booking -----------------------------//
Route::get('form/allbooking', [App\Http\Controllers\BookingController::class, 'allbooking'])->middleware('auth')->name('form/allbooking');
Route::get('form/booking/edit/{bkg_id}', [App\Http\Controllers\BookingController::class, 'bookingEdit']);
Route::get('form/booking/add', [App\Http\Controllers\BookingController::class, 'bookingAdd'])->middleware('auth')->name('form/booking/add');

Route::post('form/booking/save', [App\Http\Controllers\BookingController::class, 'saveRecord'])->middleware('auth')->name('form/booking/save');
Route::post('form/booking/update', [App\Http\Controllers\BookingController::class, 'updateRecord'])->middleware('auth')->name('form/booking/update');
Route::post('form/booking/delete', [App\Http\Controllers\BookingController::class, 'deleteRecord'])->middleware('auth')->name('form/booking/delete');

// ----------------------------- customers -----------------------------//
Route::get('form/allcustomers/page', [App\Http\Controllers\CustomerController::class, 'allCustomers'])->middleware('auth')->name('form/allcustomers/page');
Route::get('form/addcustomer/page', [App\Http\Controllers\CustomerController::class, 'addCustomer'])->middleware('auth')->name('form/addcustomer/page');
Route::post('form/addcustomer/save', [App\Http\Controllers\CustomerController::class, 'saveCustomer'])->middleware('auth')->name('form/addcustomer/save');
Route::get('form/customer/edit/{bkg_customer_id}', [App\Http\Controllers\CustomerController::class, 'updateCustomer']);
Route::post('form/customer/update', [App\Http\Controllers\CustomerController::class, 'updateRecord'])->middleware('auth')->name('form/customer/update');
Route::post('form/customer/delete', [App\Http\Controllers\CustomerController::class, 'deleteRecord'])->middleware('auth')->name('form/customer/delete');

// ----------------------------- rooms -----------------------------//
Route::get('form/allrooms/page', [App\Http\Controllers\RoomsController::class, 'allrooms'])->middleware('auth')->name('form/allrooms/page');
Route::get('form/addroom/page', [App\Http\Controllers\RoomsController::class, 'addRoom'])->middleware('auth')->name('form/addroom/page');
Route::get('form/room/edit/{bkg_room_id}', [App\Http\Controllers\RoomsController::class, 'editRoom']);
Route::post('form/room/save', [App\Http\Controllers\RoomsController::class, 'saveRecordRoom'])->middleware('auth')->name('form/room/save');
Route::post('form/room/delete', [App\Http\Controllers\RoomsController::class, 'deleteRecord'])->middleware('auth')->name('form/room/delete');
Route::post('form/room/update', [App\Http\Controllers\RoomsController::class, 'updateRecord'])->middleware('auth')->name('form/room/update');


// ----------------------------- staff -----------------------------//
Route::get('form/staff/page', [App\Http\Controllers\StaffController::class, 'allStaff'])->middleware('auth')->name('form.allstaff.page');
Route::get('form/addstaff/page', [App\Http\Controllers\StaffController::class, 'addStaff'])->middleware('auth')->name('form.addstaff.page');
Route::get('form/staff/edit/{bkg_room_id}', [App\Http\Controllers\StaffController::class, 'editStaff']);
Route::post('form/staff/save', [App\Http\Controllers\StaffController::class, 'saveRecordStaff'])->middleware('auth')->name('form.staff.save');
Route::post('form/staff/delete', [App\Http\Controllers\StaffController::class, 'deleteRecord'])->middleware('auth')->name('form.staff.delete');
Route::post('form/staff/update', [App\Http\Controllers\StaffController::class, 'updateRecord'])->middleware('auth')->name('form.staff.update');



// ----------------------------- Employee -----------------------------//
Route::get('form-employee-page', [App\Http\Controllers\EmployeeController::class, 'allEmployee'])->middleware('auth')->name('form.allemployee.page');
Route::get('form-add-employee-page', [App\Http\Controllers\EmployeeController::class, 'addEmployee'])->middleware('auth')->name('form.addemployee.page');
Route::get('form-employee-edit/{id}', [App\Http\Controllers\EmployeeController::class, 'editEmployee'])->name('form.employee.edit');
Route::post('form-employee-save', [App\Http\Controllers\EmployeeController::class, 'saveRecordEmployee'])->middleware('auth')->name('form.employee.save');
Route::post('form-employee-delete', [App\Http\Controllers\EmployeeController::class, 'deleteRecord'])->middleware('auth')->name('form.employee.delete');
Route::post('form-employee-update', [App\Http\Controllers\EmployeeController::class, 'updateRecord'])->middleware('auth')->name('form.employee.update');


// ----------------------------- Leave -----------------------------//
Route::get('leave', [App\Http\Controllers\LeaveController::class, 'allLeaves'])->middleware('auth')->name('form.allleave.page');
Route::get('add-leave', [App\Http\Controllers\LeaveController::class, 'addLeave'])->middleware('auth')->name('form.addleave.page');
Route::get('leave-edit/{id}', [App\Http\Controllers\LeaveController::class, 'editLeave'])->name('form.leave.edit');
Route::post('leave-save', [App\Http\Controllers\LeaveController::class, 'saveRecordLeave'])->middleware('auth')->name('form.leave.save');
Route::post('leave-delete', [App\Http\Controllers\LeaveController::class, 'deleteRecord'])->middleware('auth')->name('form.leave.delete');
Route::post('leave-update', [App\Http\Controllers\LeaveController::class, 'updateRecord'])->middleware('auth')->name('form.leave.update');

// ----------------------------- Holidays -----------------------------//
Route::get('holiday', [App\Http\Controllers\HolidayController::class, 'allholidays'])->middleware('auth')->name('form.allHoliday.page');
Route::get('add-holiday', [App\Http\Controllers\HolidayController::class, 'addholiday'])->middleware('auth')->name('form.addHoliday.page');
Route::get('holiday-edit/{id}', [App\Http\Controllers\HolidayController::class, 'editholiday'])->name('form.Holiday.edit');
Route::post('holiday-save', [App\Http\Controllers\HolidayController::class, 'saveRecordholiday'])->middleware('auth')->name('form.Holiday.save');
Route::post('holiday-delete', [App\Http\Controllers\HolidayController::class, 'deleteRecord'])->middleware('auth')->name('form.Holiday.delete');
Route::post('holiday-update', [App\Http\Controllers\HolidayController::class, 'updateRecord'])->middleware('auth')->name('form.Holiday.update');


// ----------------------------- Attendance -----------------------------//
Route::get('attendance', [App\Http\Controllers\AttendanceController::class, 'allattendance'])->middleware('auth')->name('form.Attendance.all');
Route::get('add-attendance', [App\Http\Controllers\AttendanceController::class, 'addattendance'])->middleware('auth')->name('form.Attendance.add');
Route::get('attendance-edit/{id}', [App\Http\Controllers\AttendanceController::class, 'editattendance'])->name('form.Attendance.edit');
Route::post('attendance-save', [App\Http\Controllers\AttendanceController::class, 'saveRecordattendance'])->middleware('auth')->name('form.Attendance.save');
Route::post('attendance-delete', [App\Http\Controllers\AttendanceController::class, 'deleteRecord'])->middleware('auth')->name('form.Attendance.delete');
Route::post('attendance-update', [App\Http\Controllers\AttendanceController::class, 'updateRecord'])->middleware('auth')->name('form.Attendance.update');


// ----------------------------- Invoice -----------------------------//
Route::get('Invoices', [App\Http\Controllers\InvoiceController::class, 'all'])->middleware('auth')->name('form.Invoice.all');
Route::get('add-Invoice', [App\Http\Controllers\InvoiceController::class, 'addInvoice'])->middleware('auth')->name('form.Invoice.add');
Route::get('Invoice-edit/{id}', [App\Http\Controllers\InvoiceController::class, 'editInvoice'])->name('form.Invoice.edit');
Route::post('Invoice-save', [App\Http\Controllers\InvoiceController::class, 'saveRecordInvoice'])->middleware('auth')->name('form.Invoice.save');
Route::post('Invoice-delete', [App\Http\Controllers\InvoiceController::class, 'deleteRecord'])->middleware('auth')->name('form.Invoice.delete');
Route::post('Invoice-update', [App\Http\Controllers\InvoiceController::class, 'updateRecord'])->middleware('auth')->name('form.Invoice.update');