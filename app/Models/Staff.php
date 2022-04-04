<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table ="staffs";
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

}
