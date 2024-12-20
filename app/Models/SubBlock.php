<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'table',
        'comments',
        'blockedId',
        'blockedBy'
    ];

    public function driver(): HasMany
    {
        return $this->hasMany(Driver::class, 'id', 'blockedId');
    }

    public function subscriber(): HasMany
    {
        return $this->hasMany(Subscriber::class, 'id', 'blockedBy');
    }
}
