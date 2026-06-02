<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'member_id',
        'unique_card_number',
        'customer_name',
        'customer_phone',
        'customer_address',
        'payment_method',
        'status',
        'transaction_id',
        'payment_status',
        'payment_date',
        'payment_details',
        'total_amount',
        'discount_amount',
        'final_amount',
        'student_card_used',
        'items',
    ];

    protected $casts = [
        'total_amount'    => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount'    => 'decimal:2',
        'student_card_used' => 'boolean',
        'items'           => 'array',
        'payment_date'    => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Accessor for payment status badge.
     */
    public function getPaymentBadgeAttribute(): string
    {
        return match ($this->payment_status) {
            'paid'      => '<span class="badge bg-success">Paid</span>',
            'failed'    => '<span class="badge bg-danger">Failed</span>',
            'cancelled' => '<span class="badge bg-warning text-dark">Cancelled</span>',
            default     => '<span class="badge bg-secondary">Unpaid</span>',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'confirmed'  => '<span class="badge bg-info">Confirmed</span>',
            'completed'  => '<span class="badge bg-success">Completed</span>',
            'canceled'   => '<span class="badge bg-danger">Canceled</span>',
            default      => '<span class="badge bg-warning text-dark">Pending</span>',
        };
    }
}
