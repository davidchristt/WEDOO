<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class catering extends Model
{
    protected $primaryKey = 'id_catering';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_catering',
        'nama',
        'kontak',
        'biaya',
        'deskripsi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_catering)) {
                $model->id_catering = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'CTR';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('caterings')->lockForUpdate()->orderBy('id_catering', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_catering, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_catering', $newId)->exists());

        return $newId;
    }
}
