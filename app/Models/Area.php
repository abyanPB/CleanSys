<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Area extends Model
{
    use HasFactory;

    protected $table='area';
    protected $primaryKey='id_area';
    protected $keyType = 'string';
    protected $fillable=[
        'nama_area',
        'desc_area',
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
        return $this->hasMany(LaporanGrooming::class, 'id_area', 'id_area');
    }

    public function laporanPjkp(): HasMany
    {
        return $this->hasMany(LaporanPjkp::class, 'id_area', 'id_area');
    }
}
