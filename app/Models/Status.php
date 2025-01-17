<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nama_status'
    ];
    public function produk():HasMany
    {
        return $this->hasMany(Produk::class, 'status_id', 'id_status');
    }
}
