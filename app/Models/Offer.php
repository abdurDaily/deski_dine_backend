<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'name',
        'description',
        'discount_percent',
        'applicable_to',
        'min_total',
        'is_first_order',
        'is_active',
    ];

    protected $casts = [
        'discount_percent' => 'integer',
        'min_total' => 'decimal:2',
        'is_first_order' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
