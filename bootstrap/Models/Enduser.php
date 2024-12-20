<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enduser extends Model
{
    use HasFactory;
    protected $table  ='end_users';
    protected $guard = 'enduser';
    
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'phone_code',
        'name',
        'password',
        'plant_code',
        'is_live',
        'department',
        'profile_image',
        'file_data',
        'last_login',
        'roles',
        'email_verified',
        'phone_verified',
        'remember_token',
        'user_timezone',
        'dop',
        'gender',
    ];
}
