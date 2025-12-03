<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $fillable = ['name','brand_origin', 'image', 'id_color'];
    
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/1.png');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'brand_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color');
    }
}
