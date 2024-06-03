<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_venue';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_venue',
        'id_gedung',
        'gambar',
        'alamat',
        'biaya',
        'tipe',
        'deskripsi',
        'kota',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_venue)) {
                $model->id_venue = $model->generateCustomId();
            }
        });
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'id_gedung', 'id_gedung');
    }

    public function generateCustomId()
    {
        $prefix = 'VNE';
        $length = 2;

        do {
            DB::beginTransaction();

            try {
                $lastRecord = DB::table('venues')->lockForUpdate()->orderBy('id_venue', 'desc')->first();
                $lastIdNumber = $lastRecord ? intval(substr($lastRecord->id_venue, strlen($prefix))) : 0;
                $newIdNumber = $lastIdNumber + 1;
                $newId = $prefix . str_pad($newIdNumber, $length, '0', STR_PAD_LEFT);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } while (self::where('id_venue', $newId)->exists());

        return $newId;
    }
}


