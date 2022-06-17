<?php

use App\Models\Dealer;
use App\Models\Gallery;
use App\Models\Item;
use App\Models\Retailer;

function allItem(){
    return Item::all();
}

function allRetailer(){
    return Retailer::all();
}

function allDealer(){
    return Dealer::all();
}

function allGallery(){
    return Gallery::all();
}
