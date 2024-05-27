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
        'user_id',
        'area_id',
        'sop_id',
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
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }

    //Relasi ke Area
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id_area');
    }

    //Relasi ke Sop
    public function sop(): BelongsTo
    {
        return $this->belongsTo(Sop::class, 'sop_id', 'id_sop');
    }

    //Relasi ke Tanggapan PJKP
    public function tanggapanPjkps(): HasMany //HasMany (Foreign Key, Local Key)
    {
        return $this->hasMany(TanggapanPjkp::class, 'lp_id', 'id_lp');
    }
}
