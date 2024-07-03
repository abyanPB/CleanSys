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

    // Relasi ke Supervisor
    public function supervisor(): BelongsTo //BelongsTo (Foreign Key, OwnerKey)
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'id_users');
    }

    //Relasi ke Supervisor
    public function supervisorUsers(): HasMany //HasMany (Foreign Key, Local Key)
    {
        return $this->hasMany(User::class, 'supervisor_id', 'id_users');
    }

    //Relasi ke Laporan Grooming
    public function laporanGroomings(): HasMany
    {
        return $this->hasMany(LaporanGrooming::class, 'id_users', 'id_users');
    }

    //Relasi ke Laporan Pjkp
    public function laporanPjkps(): HasMany
    {
        return $this->hasMany(LaporanPjkp::class, 'id_users', 'id_users');
    }

    //Relasi ke Tanggapan Grooming
    public function tanggapanGroomings(): HasMany
    {
        return $this->hasMany(TanggapanGrooming::class, 'id_users', 'id_users');
    }

    //Relasi ke Tanggapan Pjkp
    public function tanggapanPjkps(): HasMany
    {
        return $this->hasMany(TanggapanPjkp::class, 'id_users', 'id_users');
    }

    //Relasi ke Area Responsibility
    public function areaResponsibilities(): HasMany
    {
        return $this->hasMany(AreaResponsibility::class, 'id_users', 'id_users');
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
