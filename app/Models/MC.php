<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MC extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_Souvenir';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_MC',
        'nama',
        'kontak',
        'biaya',
        'ketersediaan',
        'deskripsi',
    ];

    const KETERSEDIAAN_OPSI = [
        'tersedia' => 'Tersedia',
        'habis' => 'Habis',
        'preorder' => 'Preorder',
    ];
}
