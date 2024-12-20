<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    use HasFactory;
    protected $table = "sites";
    protected  $fillable = ['sitename', 'phone', 'address', 'images', 'user_app', 'driver_app', 'maintainance', 'userToken', 'driverToken', 'main_logo', 'sidebar_logo', 'sidebar_small_logo', 'favicon'];
}
