<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entertaiment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_entertaiment';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_entertaiment',
        'nama',
        'harga',
        'kontak',
        'kategori',
        'deskripsi',
    ];
}
