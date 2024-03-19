<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Sop extends Model
{
    use HasFactory;

    protected $table='sop';
    protected $primaryKey='id_sop';
    protected $keyType = 'string';
    protected $fillable=[
        'nama_sop',
        'ket_sop',
        'image_sop',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    public function laporanGrooming(): HasMany
    {
        return $this->hasMany(LaporanGrooming::class, 'id_sop', 'id_sop');
    }

    public function laporanPjkp(): HasMany
    {
        return $this->hasMany(LaporanPjkp::class, 'id_sop', 'id_sop');
    }
}
