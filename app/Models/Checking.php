<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'admin_id',
        'notes'
    ];

    public function admin():BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
