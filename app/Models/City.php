<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at'
    ];

    public function users()
    {
        // return $this->hasMany(User::class);
        return $this->hasMany(User::class, 'city_id', 'id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:H:ia',
        'updated_at' => 'datetime:Y-m-d',
        'active' => 'boolean',
    ];

    public function getActiveStatusAttribute()
    {
        return $this->active == 1 ? 'Active' : 'InActive';
    }
}
