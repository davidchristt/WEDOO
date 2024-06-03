<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class penghulu extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penghulu';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_penghulu',
        'nama',
        'kontak',
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
            if (empty($model->id_penghulu)) {
                $model->id_penghulu = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'PGHL';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('penghulus')->lockForUpdate()->orderBy('id_penghulu', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_penghulu, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_penghulu', $newId)->exists());

        return $newId;
    }
}
