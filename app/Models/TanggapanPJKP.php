<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TanggapanPJKP extends Model
{
    use HasFactory;

    protected $table='tanggapan_pjkp';
    protected $primaryKey='id_tp';
    protected $keyType = 'string';
    protected $fillable=[
        'lp_id',
        'tgl_tp',
        'tanggapan_pjkp',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    //Relasi ke Laporan PJKP
    public function laporanPjkp(): BelongsTo //BelongsTo (Foreign Key, OwnerKey)
    {
        return $this->belongsTo(LaporanPjkp::class, 'lp_id', 'id_lp');
    }

    //Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }
}
