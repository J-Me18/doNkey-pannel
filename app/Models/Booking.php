<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function bookingRating(): HasOne
    {
        return $this->hasOne(BookingRating::class, 'booking_id', 'booking_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'user_id');
    }

    public function bookingPayment(): HasMany
    {
        return $this->hasMany(BookingPayment::class, 'booking_id', 'booking_id');
    }

    public function driverasuser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'accepted', 'id');
    }

    public function pincode(): BelongsTo
    {
        return $this->belongsTo(Pincode::class, 'pincode', 'pincode');
    }

    public function driver(): HasMany
    {
        return $this->hasMany(Driver::class, 'id', 'accepted');
    }

    protected $table  = 'booking';
    // public function pincode(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $value->json_decode()
    //     );
    // }

    public function getCreatedAtAttribute($createdAt)
    {
        $tz = $createdAt;  // "2019-01-16 18:21:31" (UTC Time)
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $tz, 'UTC');
        $date->setTimezone('Asia/Kolkata');
        return $date;
    }

    public function getUpdatedAtAttribute($updatedAt)
    {
        $tz = $updatedAt;  // "2019-01-16 18:21:31" (UTC Time)
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $tz, 'UTC');
        $date->setTimezone('Asia/Kolkata');
        return $date;
    }
}
