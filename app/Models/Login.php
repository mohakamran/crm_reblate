<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table = 'table_login_details';
    protected $fillable = [
        'username', // Add 'username' to the fillable attributes
    ];
}
