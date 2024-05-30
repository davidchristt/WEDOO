<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobil extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_MC';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_MC',
        'nama_mobil',
        'merk',
        'kapasitas',
        'harga',
    ];
}
