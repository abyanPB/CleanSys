<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class TanggapanGrooming extends Model
{
    use HasFactory;

    protected $table='tanggapan_grooming';
    protected $primaryKey='id_tg';
    protected $keyType = 'string';
    protected $fillable=[
        'id_lg',
        'tgl_tg',
        'tanggapan_grooming',
        'id_users'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    public function laporanGrooming(): BelongsTo
    {
        return $this->belongsTo(LaporanGrooming::class, 'id_lg', 'id_lg');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
