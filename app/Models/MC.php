<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MC extends Model
{
    use HasFactory;

    protected $table = 'mcs'; // Make sure this matches your table name
    protected $primaryKey = 'id_mc';
    protected $keyType = 'char';
    public $incrementing = false;

    protected $fillable = [
        'id_mc',
        'nama',
        'kontak',
        'biaya',
        'ketersediaan',
        'deskripsi'
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
            if (empty($model->id_mc)) {
                $model->id_mc = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'MC';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('mcs')->lockForUpdate()->orderBy('id_mc', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_mc, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_mc', $newId)->exists());

        return $newId;
    }
}

