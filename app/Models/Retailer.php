<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Retailer extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function salesman()
    {
        return $this->belongsTo(Salesman::class);
    }

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}
