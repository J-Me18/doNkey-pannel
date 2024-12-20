<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivernotify extends Model
{
    use HasFactory;
    protected $table = 'driver_notify';
    protected $fillable = ['readBy'];
}
