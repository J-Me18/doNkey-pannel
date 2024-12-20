<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sender_id',
        'reciver_id',
        'message',
        'attachment',
        'readBy'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M y, h:i');
    }
    
}
