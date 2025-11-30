<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'ongkir',
        'toko_id',
        'brand_id',
        'kategori_id',
        'id_color',
        'gambar',
        'deskripsi',
        'tanggal',
    ];

    public function toko() {
        return $this->belongsTo(Toko::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
