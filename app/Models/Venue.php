<?php

// app/Models/Venue.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_venue';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_venue',
        'id_gedung',
        'alamat',
        'biaya',
        'tipe',
        'deskripsi',
        'kota',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'id_gedung', 'id_gedung');
    }
}

