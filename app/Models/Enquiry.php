<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enquiry extends Model
{
    use HasFactory;
    protected $table = 'enquiry';
    protected $fillable = [
        'name',
        'mailId',
        'area',
        'mobile',
        'category',
        'pincode',
        'description',
        'ficon',
        'subscriberId',
        'emp_id'
    ];
    protected $casts = [
        'pincode' => 'array',

        ];

        public function subscriber()
        {
            return $this->belongsTo('App\Models\Subscriber' , 'subscriberId');
        }

        public function enquiryComment():HasMany
        {
            return $this->hasMany(EnquiryComment::class,'enquiry_id','id');
        }

}
