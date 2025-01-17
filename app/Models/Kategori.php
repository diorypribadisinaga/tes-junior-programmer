<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $keyType = 'integer';
    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'nama_kategori'
    ];

    public function produk():HasMany
    {
        return $this->hasMany(Produk::class, 'kategori_id', 'id_kategori');
    }
}
