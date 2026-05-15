<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;

class MenuVariation extends Model
{
    protected $fillable = [
        'menu_id', // Make sure this matches your migration column
        'name',
        'price',
        'image'
    ];

    // Relationship: Variation belongs to a Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
