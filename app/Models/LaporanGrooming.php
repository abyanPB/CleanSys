<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class LaporanGrooming extends Model
{
    use HasFactory;

    protected $table='laporan_grooming';
    protected $primaryKey='id_lg';
    protected $keyType = 'string';
    protected $fillable=[
        'id_users',
        'id_area',
        'id_sop',
        'tgl_lg',
        'ket_lg',
        'image_lg',
        'status_lg'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }

    public function sop(): BelongsTo
    {
        return $this->belongsTo(Sop::class, 'id_sop', 'id_sop');
    }

    public function tanggapanGrooming(): HasMany
    {
        return $this->hasMany(TanggapanGrooming::class, 'id_lg', 'id_lg');
    }
}
