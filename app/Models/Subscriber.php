<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Subscriber extends Authenticatable
{
    use HasFactory, HasRoles;
    protected $table = 'subscriber';
    protected $guard = [];
    protected $fillable = ['notify', 'platform_fee', 'need_to_pay'];
    protected $dateFormat = 'Y-m-d';
    public function subUnblock(): BelongsTo
    {
        return $this->belongsTo(SubUnblock::class, 'id', 'unblockBy');
    }

    public function subBlock(): BelongsTo
    {
        return $this->belongsTo(SubBlock::class, 'id', 'blockedBy');
    }

    public function pincode(): BelongsTo
    {
        return $this->belongsTo(Pincode::class, 'pincode', 'pincode');
    }

    public function blocklist(): BelongsTo
    {
        return $this->belongsTo(Blocklist::class, 'id', 'blockedId');
    }

    public function driver(): HasMany
    {
        return $this->hasMany(Driver::class, 'subscriberId', 'id');
    }

    protected $casts = [
        'subscriptionDate' => 'datetime',
        'expiryDate' => 'datetime'
    ];
}
