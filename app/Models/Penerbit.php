<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    
    protected $table = 'penerbit';
    const UPDATED_AT = null;

    protected $fillable = [
        'nama_penerbit',
        'nama_sales',
        'kontak_sales',
        'alamat',
        'wilayah_asal',
    ];
}
