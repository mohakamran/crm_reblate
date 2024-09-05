<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'employee_id', 'month', 'year', 'tasks_completed',
        'projects_worked_on', 'goals_achieved', 'challenges_faced',
        'goals_for_next_month', 'admin_comments', 'manager_comments'
    ];
}
