<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enduser extends Model
{
    use HasFactory;
    protected $table  ='users';
    protected $guard = 'enduser';
    
    protected $guarded = [];
    
    public function userAddress():HasMany
    {
        return $this->hasMany(UserAddress::class,'user_id','user_id');
    }
    public function enduserreason():HasMany
     {
        return $this->hasMany(EnduserReason::class,'user_id','user_id');
     }
}
