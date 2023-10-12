<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string instagram_username
 * @property string instagram_user_id
 * @property string instagram_state
 * @property string instagram_access_token
 * @property string instagram_token_expired_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'instagram_username',
        'instagram_user_id',
        'instagram_state',
        'instagram_access_token',
        'instagram_token_expired_at',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $appends = [
        'instagram_username',
        'instagram_user_id',
        'instagram_state',
        'instagram_access_token',
        'instagram_token_expired_at',
    ];

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

    public static function user() : User | null
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }
}
