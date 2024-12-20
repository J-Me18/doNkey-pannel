<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory,SoftDeletes;
    protected $guard='user_address';
    protected $table='user_address';
    protected $guarded = [];

    public function user():BelongsTo
    {
        return $this->belongsTo(Enduser::class,'user_id');
    }

    
}
