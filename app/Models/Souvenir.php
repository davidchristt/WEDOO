<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'gambar,'
    ];

    const KETERSEDIAAN_OPSI = [
        'Tersedia' => 'Tersedia',
        'Habis' => 'Habis',
        'Tunggu' => 'Tunggu',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_Souvenir)) {
                $model->id_Souvenir = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'SVR';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('souvenirs')->lockForUpdate()->orderBy('id_Souvenir', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_Souvenir, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_Souvenir', $newId)->exists());

        return $newId;
    }
}

