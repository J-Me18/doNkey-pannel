<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'driver';

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class, 'id', 'subscriberId');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'accepted', 'id');
    }

    public function subBlock(): BelongsTo
    {
        return $this->belongsTo(SubBlock::class, 'id', 'blockedId');
    }

    public function subUnblock(): BelongsTo
    {
        return $this->belongsTo(SubUnblock::class, 'id', 'unblockedId');
    }
}
