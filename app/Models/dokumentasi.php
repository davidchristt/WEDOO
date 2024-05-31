<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class dokumentasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_dokumentasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_dokumentasi',
        'nama',
        'kamera',
        'kontak',
        'biaya',
        'ketersediaan',
        'deskripsi',
    ];

    const KETERSEDIAAN_OPSI = [
        'tersedia' => 'Tersedia',
        'habis' => 'Habis',
        'Tunggu' => 'Tunggu',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_dokumentasi)) {
                $model->id_dokumentasi = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'DKM';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('dokumentasis')->lockForUpdate()->orderBy('id_dokumentasi', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_dokumentasi, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_dokumentasi', $newId)->exists());

        return $newId;
    }
}
