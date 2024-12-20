<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnduserReason extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'admin_id',
        'user_id',
        'status',
        'reason'
    ];
    public function enduser(): BelongsTo
    {
        return $this->belongsTo(Enduser::class, 'usesr_id', 'user_id');
    }
}
