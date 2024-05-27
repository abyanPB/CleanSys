<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TanggapanGrooming extends Model
{
    use HasFactory;

    protected $table='tanggapan_grooming';
    protected $primaryKey='id_tg';
    protected $keyType = 'string';
    protected $fillable=[
        'lg_id',
        'tgl_tg',
        'tanggapan_grooming',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    //Relasi ke Laporan Grooming
    public function laporanGrooming(): BelongsTo //BelongsTo (Foreign Key, OwnerKey)
    {
        return $this->belongsTo(LaporanGrooming::class, 'lg_id', 'id_lg');
    }

    //Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }
}
