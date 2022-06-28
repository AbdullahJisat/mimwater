<?php

use App\Models\Dealer;
use App\Models\Gallery;
use App\Models\Item;
use App\Models\NewsEvents;
use App\Models\ProductionFacilities;
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

function allProductionFacilities(){
    return ProductionFacilities::all();
}

function allNewsEvents(){
    return NewsEvents::all();
}

