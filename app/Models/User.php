<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table='users';
    protected $primaryKey='id_users';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'jk',
        'no_telepon',
        'level',
        'image_profile',
        'default_pass',
        'supervisor_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    //Relasi ke Laporan Grooming
    public function laporanGrooming(): HasMany
    {
        return $this->hasMany(LaporanGrooming::class, 'id_users', 'id_users');
    }

    //Relasi ke Laporan Pjkp
    public function laporanPjkp(): HasMany
    {
        return $this->hasMany(LaporanPjkp::class, 'id_users', 'id_users');
    }

    //Relasi ke Tanggapan Grooming
    public function tanggapanGrooming(): HasMany
    {
        return $this->hasMany(TanggapanGrooming::class, 'id_users', 'id_users');
    }

    //Relasi ke Tanggapan Pjkp
    public function tanggapanPjkp(): HasMany
    {
        return $this->hasMany(TanggapanPjkp::class, 'id_users', 'id_users');
    }

    // Relasi ke supervisor
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'id_users');
    }

    public function areaResponsibilities(): BelongsToMany
    {
        return $this->belongsToMany(Area::class, 'area_responsibilities', 'user_id', 'area_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
