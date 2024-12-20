<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;
    protected $table = 'complaints';
    protected $fillable = [
        'name',
        'mailId',
        'area', 'mobile', 'category', 'pincode', 'description', 'ficon', 'complaint',
        'complained_by', 'complained_id', 'subscriberId', 'complaintID', 'status', 'solved_by', 'solved_id'
    ];
    protected $casts = [
        'pincode' => 'array',
    ];


    public function subscriber()
    {
        return $this->belongsTo('App\Models\Subscriber', 'subscriberId');
    }
}
