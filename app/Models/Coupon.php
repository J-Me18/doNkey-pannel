<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use App\Models\Subscriber;
use App\Models\Pincode;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        "title",
        "image",
        "type",
        "is_multiple",
        "pincode_id",
        "code",
        "limit",
        "start_date",
        "expiry_date",
        "discount_type",
        "amount",
        "percentage",
        "status",
        "created_by",
        "role"
    ];

    protected $dates = [
        'start_date',
        'expiry_date',
    ];

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getExpiryDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function pincode(): BelongsTo
    {
        return $this->belongsTo(Pincode::class);
    }

    public function usedcoupon(): HasMany
    {
        return $this->hasMany(Usedcoupon::class);
    }
}

