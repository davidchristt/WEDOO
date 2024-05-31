<?php

// app/Models/Gedung.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gedung extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_gedung';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_gedung',
        'nama_gedung',
        'luas',
        'kapasitas',
        'kapasitas_parkir',
        'link_denah',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_gedung)) {
                $model->id_gedung = $model->generateCustomId();
            }
        });
    }

    public function generateCustomId()
    {
        $prefix = 'GDG';
        $length = 2;

        do {
            DB::beginTransaction();

            $lastRecord = DB::table('gedungs')->lockForUpdate()->orderBy('id_gedung', 'desc')->first();
            $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_gedung, strlen($prefix))) : 0;
            $newIdNumber = $lastIdNumber + 1;
            $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

            DB::commit();

        } while (self::where('id_gedung', $newId)->exists());

        return $newId;
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_gedung', 'gedung_id', 'fasilitas_id');
    }

    public function venues()
    {
        return $this->hasMany(Venue::class, 'id_gedung', 'id_gedung');
    }
}
