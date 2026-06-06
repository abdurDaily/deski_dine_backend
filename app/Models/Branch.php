<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'location',
        'phone',
        'foodpanda_url',
        'pathao_url',
        'foodi_url',
        'foodpanda_logo',
        'pathao_logo',
        'foodi_logo',
    ];

    /**
     * Automatically generate slug when name is set
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    /**
     * Route model binding using slug instead of ID
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

