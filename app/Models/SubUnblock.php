<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubUnblock extends Model
{
    use HasFactory;

    protected $fillable = [
        'table',
        'comments',
        'unblockedId',
        'unblockedBy'
    ];

    public function subscriber(): HasMany
    {
        return $this->hasMany(Subscriber::class, 'id', 'unblockedBy');
    }

    public function driver(): HasMany
    {
        return $this->hasMany(Driver::class, 'id', 'unblockedId');
    }
}
