<?php

// app/Models/Fasilitas.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fasilitas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_fasilitas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_fasilitas',
        'nama_fasilitas',
        'luas',
        'kapasitas',
        'deskripsi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_fasilitas)) {
                $model->id_fasilitas = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'FLS';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('fasilitass')->lockForUpdate()->orderBy('id_fasilitas', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_fasilitas, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_fasilitas', $newId)->exists());

        return $newId;
    }

    public function gedungs()
    {
        return $this->belongsToMany(Gedung::class, 'fasilitas_gedung', 'fasilitas_id', 'gedung_id');
    }
}
