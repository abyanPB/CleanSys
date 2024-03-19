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
        'id_lp',
        'tgl_tp',
        'tanggapan_pjkp',
        'id_users'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    public function laporanPjkp(): BelongsTo
    {
        return $this->belongsTo(LaporanPjkp::class, 'id_lp', 'id_lp');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
