<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;


class AreaResponsibility extends Model
{
    use HasFactory;

    protected $table='area_responsibility';
    protected $primaryKey='id_ar';
    protected $keyType = 'string';
    protected $fillable=[
        'id_users',
        'id_area',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    //Relasi ke User
    public function user(): BelongsTo //BelongsTo (Foreign Key, OwnerKey)
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    //Relasi ke Area
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }
}
