<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table ="employees";
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'staff_id',
        'joining_date',
        'ph_number',
        'fileupload',
        'role',  
     ];

    
public function attendance()
{
    return $this->hasMany('App\Models\Attendance', 'employee_id');
}
public function scopeAttendance()
{
    return $this->hasMany('App\Models\Attendance', 'employee_id');
}
}
