<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be appends.
     *
     * @var array
     */
    protected $appends = [
        'avatar_url'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role_name)
    {
        if(!is_array($role_name)) {
            $role_name = [$role_name];
        }

        return in_array($this->role->name, $role_name);
    }

    public function getAvatarUrlAttribute()
    {
        return !empty($this->avatar) ? asset("storage/users") ."/". $this->avatar : "";
    }

    public function setPasswordAttribute($value)
    {
        if(Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }
        
        $this->attributes['password'] = $value;
    }
}
