<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pincode extends Model
{
    use HasFactory;
    protected $table = 'pincode';
    
    protected $fillable =[
        'state',
        'district',
        'city',
        'taluk',
        'pincode',
        'usedBy'
    ];

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'pincode', 'pincode');
    }

    public function subscriber(): HasMany
    {
        return $this->hasMany(Subscriber::class,'pincode','[pincode]');
    }

    public function pincodebasedcategory(): HasMany
    {
        return $this->hasMany(Pincodebasedcategory::class);
    }
}

