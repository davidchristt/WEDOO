<?php

// app/Models/Gedung.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_gedung';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_gedung',
        'nama_gedung',
        'luas',
        'kapasitas',
        'kapasitas_parkir',
        'link_denah',
    ];

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_gedung', 'gedung_id', 'fasilitas_id');
    }

    public function venues()
    {
        return $this->hasMany(Venue::class, 'id_gedung', 'id_gedung');
    }
}
