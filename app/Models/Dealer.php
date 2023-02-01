<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}
