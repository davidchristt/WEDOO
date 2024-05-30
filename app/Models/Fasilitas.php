<?php

// app/Models/Fasilitas.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_fasilitas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_fasilitas',
        'nama_fasilitas',
        'luas',
        'kapasitas',
        'deskripsi',
    ];

    public function gedungs()
    {
        return $this->belongsToMany(Gedung::class, 'fasilitas_gedung', 'fasilitas_id', 'gedung_id');
    }
}
