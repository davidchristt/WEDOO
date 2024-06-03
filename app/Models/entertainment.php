<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class entertainment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_entertainment';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_entertainment',
        'nama',
        'biaya',
        'kontak',
        'kategori',
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
            if (empty($model->id_entertainment)) {
                $model->id_entertainment = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'DKM';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('entertainments')->lockForUpdate()->orderBy('id_entertainment', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_entertainment, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_entertainment', $newId)->exists());

        return $newId;
    }
}
