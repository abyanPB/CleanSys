<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaporanPJKP extends Model
{
    use HasFactory;

    protected $table='laporan_pjkp';
    protected $primaryKey='id_lp';
    protected $keyType = 'string';
    protected $fillable=[
        'id_users',
        'id_area',
        'id_sop',
        'tgl_lp',
        'image_lp',
        'status_lp'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    // Relasi ke User
    public function user(): BelongsTo //BelongsTo (Foreign Key, OwnerKey)
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    //Relasi ke Area
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }

    //Relasi ke Sop
    public function sop(): BelongsTo
    {
        return $this->belongsTo(Sop::class, 'id_sop', 'id_sop');
    }

    //Relasi ke Tanggapan PJKP
    public function tanggapanPjkps(): HasMany //HasMany (Foreign Key, Local Key)
    {
        return $this->hasMany(TanggapanPJKP::class, 'id_lp', 'id_lp');
    }
}
