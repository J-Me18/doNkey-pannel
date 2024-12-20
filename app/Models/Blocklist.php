<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blocklist extends Model
{
    use HasFactory;
    protected $table  ='blocklist';

    protected $fillable = [
        'comments',
        'table',
        'blockedId',
        'blockedBy'
    ];

    public function subscriber(): HasMany
    {
       return $this->hasMany(Subscriber::class,'id','blockedId'); 
    }
}
