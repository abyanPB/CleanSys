<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    //Relasi ke Laporan Grooming
    public function laporanGroomings(): HasMany //HasMany (Foreign Key, Local Key)
    {
        return $this->hasMany(LaporanGrooming::class, 'id_area', 'id_area');
    }

    //Relasi ke Laporan Pjkp
    public function laporanPjkps(): HasMany
    {
        return $this->hasMany(LaporanPjkp::class, 'id_area', 'id_area');
    }

    //Relasi ke Laporan Guest
    public function laporanGuests(): HasMany
    {
        return $this->hasMany(LaporanGuest::class, 'id_area', 'id_area');
    }

    //Relasi ke Area Responsibility
    public function areaResponsibilities(): HasMany
    {
        return $this->hasMany(AreaResponsibility::class, 'id_area', 'id_area');
    }
}
