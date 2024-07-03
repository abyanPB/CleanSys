<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanGuest extends Model
{
    use HasFactory;

    protected $table = 'laporan_guest';
    protected $primaryKey = 'id_guest';
    protected $keyType = 'string';
    protected $fillable = [
        'id_area',
        'jenis_laporan',
        'nama_guest',
        'level_guest',
        'image_guest',
        'tgl_guest',
        'ket_guest',
        'status_laporan',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    //Relasi ke Area
    public function area(): BelongsTo //BelongsTo (Foreign Key, OwnerKey)
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }
}
