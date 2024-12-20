<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingRating extends Model
{
    use HasFactory;

    protected $table  = 'booking_rating';

    protected $fillable = [
        'booking_id',
        'customer_id',
        'driver_id',
        'rating',
        'remarks'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}
