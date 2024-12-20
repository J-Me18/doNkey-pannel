<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentDetails extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_no', 'subscriberId', 'payment_id', 'status_code', 'amount', 'signature','type'];

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class, 'subscriberId', 'subscriberId');
    }
}

