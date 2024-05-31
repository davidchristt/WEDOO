<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class mobil extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mobil';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_mobil',
        'nama_mobil',
        'merk',
        'kapasitas',
        'harga',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_mobil)) {
                $model->id_mobil = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'MBL';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('mobils')->lockForUpdate()->orderBy('id_mobil', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_mobil, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_mobil', $newId)->exists());

        return $newId;
    }
}
