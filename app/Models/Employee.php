<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $guard = ['employee'];

    protected $fillable = [
        'name',
        'emp_id',
        'email',
        'official_mail',
        'password',
        'gender',
        'mobile',
        'official_mobile',
        'profile',
        'other',
        'education',
        'blood_group',
        'address',
        'current_address',
        'aadhar',
        'pan',
        'joining_date',
        'payment',
        'subscriber_id',
        'employee_id',
        'location',
        'bankacno',
        'ifsccode'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'roles',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'joining_date' => 'datetime'
    ];
}
