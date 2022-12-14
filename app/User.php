<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','create_at','updated_at','last_name','first_name','role'
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
    
    // public function isSuperAdmin()
    // {
    //     if($this->role ==='SUPER_ADMIN')
    //     { 
    //         return true; 
    //     } 
    //     else 
    //     { 
    //         return false; 
    //     }
    // }

    // public function isAdmin()
    // {
    //     if($this->role ==='ADMIN')
    //     { 
    //         return true; 
    //     } 
    //     else 
    //     { 
    //         return false; 
    //     }
    // }
    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }
}
