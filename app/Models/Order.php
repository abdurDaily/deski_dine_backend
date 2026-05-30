<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'member_id',
        'unique_card_number',
        'customer_name',
        'customer_phone',
        'customer_address',
        'payment_method',
        'status',
        'total_amount',
        'discount_amount',
        'final_amount',
        'student_card_used',
        'items',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'student_card_used' => 'boolean',
        'items' => 'array',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
