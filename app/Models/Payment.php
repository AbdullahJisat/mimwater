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

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', \Carbon\Carbon::today());
    }

    public function scopePaymentStatus($query, $type)
    {
        return $query->wherePaymentStatus($type);
    }

    public function scopeDealer($query)
    {
        return $query->whereDealerId(auth('dealer')->user()->id);
    }
}
