<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutItem extends Model
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
}
