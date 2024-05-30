<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_Souvenir';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_Souvenir',
        'nama',
        'jenis',
        'harga',
        'ketersediaan',
        'deskripsi',
    ];

    const KETERSEDIAAN_OPSI = [
        'tersedia' => 'Tersedia',
        'habis' => 'Habis',
        'preorder' => 'Preorder',
    ];
}

