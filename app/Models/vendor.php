<?php

// app/Models/Vendor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_vendor';
    protected $keyType = 'char';
    public $incrementing = false;

    protected $fillable = [
        'id_vendor', 'nama' ,'id_venue', 'id_souvenir', 'id_penghulu', 'id_mc', 'id_mobil',
        'id_akomodasi', 'id_dokumentasi', 'id_catering', 'id_entertainment','id_perias'
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'id_venue');
    }

    public function souvenir()
    {
        return $this->belongsTo(Souvenir::class, 'id_souvenir');
    }

    public function penghulu()
    {
        return $this->belongsTo(Penghulu::class, 'id_penghulu');
    }

    public function mc()
    {
        return $this->belongsTo(MC::class, 'id_mc');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil');
    }

    public function akomodasi()
    {
        return $this->belongsTo(akomodasi::class, 'id_akomodasi');
    }

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class, 'id_dokumentasi');
    }

    public function catering()
    {
        return $this->belongsTo(Catering::class, 'id_catering');
    }

    public function entertainment()
    {
        return $this->belongsTo(entertainment::class, 'id_entertainment');
    }

    public function perias()
    {
        return $this->belongsTo(perias::class, 'id_perias');
    }
}

