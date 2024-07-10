<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'id');
    }
}
