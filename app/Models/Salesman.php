<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Salesman extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
    ];

    public function retailers()
    {
        return $this->hasMany(Retailer::class);
    }

    public function stockItemPrices()
    {
        // return $this->hasManyThrough(Retailer::class, Salesman::class, 'retailer_id', 'salesman_id');
        return $this->hasManyThrough(
            StockItem::class,
            Retailer::class,
            'salesman_id', // Foreign key on users table...
            'retailer_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
}


// salesman
//     id - integer
//     name - string

// retailer
//     id - integer
//     salesman_id - integer
//     name - string

// stockitem
//     id - integer
//     retailer_id - integer
//     title - string
