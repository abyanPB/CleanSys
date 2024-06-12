<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaporanGrooming extends Model
{
    use HasFactory;

    protected $table='laporan_grooming';
    protected $primaryKey='id_lg';
    protected $keyType = 'string';
    protected $fillable=[
        'user_id',
        'tgl_lg',
        'image_lg',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    //Relasi ke User
    public function user(): BelongsTo //BelongsTo (Foreign Key, Owner Key)
    {
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }

    //Relasi ke Tanggapan Grooming
    public function tanggapanGroomings(): HasMany //HasMany (Foreign Key, Local Key)
    {
        return $this->hasMany(TanggapanGrooming::class, 'lg_id', 'id_lg');
    }
}
