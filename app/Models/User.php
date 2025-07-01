<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'agency_id',
        'role_id',
        'user_type',
        'is_active',
        'last_login_at',
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
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isSuperAdmin()
    {
        return $this->user_type === 'super_admin';
    }

    public function isAgencyAdmin()
    {
        return $this->user_type === 'agency_admin';
    }

    public function isAgencyUser()
    {
        return $this->user_type === 'agency_user';
    }

    public function hasPermission($permission)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->role && $this->role->hasPermission($permission);
    }

    public function hasAnyPermission($permissions)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->role && $this->role->hasAnyPermission($permissions);
    }

    public function canManageAgency($agencyId = null)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isAgencyAdmin()) {
            return $agencyId ? $this->agency_id == $agencyId : true;
        }

        return false;
    }
}
