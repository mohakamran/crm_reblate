<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmployee extends Model
{
    use HasFactory;
    protected $table = 'user_employee';
    protected $fillable = [
        'username',
        'status',
        'emp_email',
        'employee_type',
        'emp_code',
        'password',
        // Remove 'remember_token' from the $fillable array
        'updated_at',
        'created_at',
    ];
}
