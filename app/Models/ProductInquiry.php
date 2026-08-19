<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInquiry extends Model
{
    protected $fillable = ['public_token', 'product_id', 'name', 'email', 'phone', 'company', 'status', 'last_message_at'];
    protected $casts = ['last_message_at' => 'datetime'];

    public function product() { return $this->belongsTo(Product::class); }
    public function messages() { return $this->hasMany(InquiryMessage::class)->oldest(); }
}
