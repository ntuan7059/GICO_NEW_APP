<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryMessage extends Model
{
    protected $fillable = ['product_inquiry_id', 'sender', 'message', 'read_at'];
    protected $casts = ['read_at' => 'datetime'];

    public function inquiry() { return $this->belongsTo(ProductInquiry::class, 'product_inquiry_id'); }
}
