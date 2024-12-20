<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnquiryComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'enquiry_id',
        'admin_id',
        'employee_id',
        'comment'
    ];

    public function enquiry(): BelongsTo
    {
        return $this->belongsTo(Enquiry::class, 'id', 'enquiry_id');
    }
}
