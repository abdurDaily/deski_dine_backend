<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'dob',
        'marriage_date',
        'address',
        'unique_card_number',
        'last4',
        'is_student',
        'type',
        'status',
        'total_purchase',
        'first_order_discount_used',
    ];

    protected $casts = [
        'is_student' => 'boolean',
        'first_order_discount_used' => 'boolean',
        'total_purchase' => 'decimal:2',
        'dob' => 'date',
        'marriage_date' => 'date',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
