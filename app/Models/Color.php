<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $primaryKey = 'id_color';

    protected $fillable = [
        'nama',
        'hex',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'id_color');
    }

    public function brands()
    {
        return $this->hasMany(Item::class, 'id_color');
    }
}
