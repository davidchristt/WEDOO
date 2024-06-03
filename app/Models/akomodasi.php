<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class akomodasi extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $primaryKey = 'id_akomodasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_akomodasi',
        'nama',
        'kontak',
        'biaya',
        'ketersediaan',
        'deskripsi',
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
            if (empty($model->id_akomodasi)) {
                $model->id_akomodasi = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'AKM';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('akomodasis')->lockForUpdate()->orderBy('id_akomodasi', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_akomodasi, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_akomodasi', $newId)->exists());

        return $newId;
    }

}
