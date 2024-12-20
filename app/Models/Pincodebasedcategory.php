<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pincodebasedcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_id',
        'pincode_id',
        'category_id',
        'status'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function pincode(): BelongsTo
    {
        return $this->belongsTo(Pincode::class);
    }
}

