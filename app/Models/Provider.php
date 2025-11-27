<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Provider extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'providers';
    protected $attributes = [
        'type' => 0, 
    ];
    protected $fillable = [
        'city',
        'username',
        'phone',
        'email',
        'password',
        'active',
        'avater',
        'type',
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


   


    public function getJWTIdentifier()   
   		{
       		return $this->getKey();
    	}

		public function getJWTCustomClaims()
    	{
        	return [];
    	}
}
