<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

   protected $guarded =[];
  /*  protected $fillable = [
        'employee_id ',
        'attendence_date',
        'attendence_status',
    ];
*/
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id');
    }
}
