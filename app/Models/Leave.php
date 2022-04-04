<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $guarded =[];
    

    public function emp()
    {
        return $this->belongsTo('App\Models\Employee', 'emp_id');
    }
  
}
