<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sop extends Model
{
    use HasFactory;

    protected $table='sop';
    protected $primaryKey='id_sop';
    protected $keyType = 'string';
    protected $fillable=[
        'nama_sop',
        'tujuan_sop',
        'cara_penggunaan_sop',
        'perawatan_peralatan_sop',
        'keselamatan_kerja_sop',
        'image_sop',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    //Relasi ke Laporan Grooming
    public function laporanGroomings(): HasMany //HasMany (Foreign Key, Local Key)
    {
        return $this->hasMany(LaporanGrooming::class, 'sop_id', 'id_sop');
    }

    //Relasi ke Laporan Pjkp
    public function laporanPjkps(): HasMany
    {
        return $this->hasMany(LaporanPjkp::class, 'sop_id', 'id_sop');
    }
}
