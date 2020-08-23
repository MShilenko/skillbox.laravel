<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

    private const ADMIN_ID = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get admin id
     * @return integer
     */
    public static function getAdminId(): int
    {
        return self::ADMIN_ID;
    }

    /**
     * Check if user has admin rights
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->id === self::ADMIN_ID;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
