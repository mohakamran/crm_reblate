<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // Add this line

class Employee extends Model
{
    use HasFactory,Notifiable;
    protected $table = 'employees';
    protected $primaryKey = 'id';

    public function projects()
{
    return $this->belongsToMany(Project::class, 'project_employee');
}
}
