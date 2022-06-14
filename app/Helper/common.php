<?php

use App\Models\Gallery;
use App\Models\Item;
use App\Models\Retailer;

function allItem(){
    return Item::all();
}

function allRetailer(){
    return Retailer::all();
}

function allGallery(){
    return Gallery::all();
}
