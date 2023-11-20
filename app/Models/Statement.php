<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }
    
    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
