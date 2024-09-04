<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'assigned_team_members',
        'budget',
        'client',
        'priority',
        'attachments',
    ];
    
    protected $casts = [
        'assigned_team_members' => 'array',
        'attachments' => 'array',
    ];

    public function teamMembers()
        {
            return $this->belongsToMany(Employee::class, 'project_employee');
        }
        public function attachments()
    {
        return $this->hasMany(ProjectAttachment::class);
    }
}
