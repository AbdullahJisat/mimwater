<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function salesman()
    {
        return $this->belongsTo(Salesman::class);
    }
}
