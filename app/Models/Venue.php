<?php

// app/Models/Venue.php
namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_venue';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_venue',
        'id_gedung',
        'gambar',
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

    public function generateCustomId()
    {
        $prefix = 'VNE';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('vendors')->lockForUpdate()->orderBy('id_vendor', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_vendor, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_vendor', $newId)->exists());

        return $newId;
    }
}

