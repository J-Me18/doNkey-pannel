<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /**
     * The database table used by the model.
     *
     * @var string
     */
    // protected $table="users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'firstname',
        'lastname',
        'phone',
        'phone_code',
        'plant_code',
        'is_live',
        'is_driver',
        'department',
        'profile_image',
        'file_data',
        'roles',
        'user_timezone',
        'dob',
        'gender',
        'email_verified_at',
        'email_verified',
        'phone_verified',
        'phone_verified_at',
        'last_login',
        'is_googleUser',
        'gender',
        'otp',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function booking(): HasMany
    {
        return $this->HasMany(Booking::class,'customer_id','user_id');
    }
    
    public function bookingDriver(): HasMany
    {
        return $this->HasMany(Booking::class,'accepted','id');
    }
}
