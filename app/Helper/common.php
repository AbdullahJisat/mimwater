<?php

use App\Models\Dealer;
use App\Models\Gallery;
use App\Models\Item;
use App\Models\NewsEvents;
use App\Models\ProductionFacilities;
use App\Models\Retailer;

use function PHPUnit\Framework\returnSelf;

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

function getAuthType(){
    if (auth('admin')->check()) {
        return 'admin';
    } elseif (auth('salesman')->check()) {
        return 'salesman';
    } elseif (auth('dealer')->check()) {
        return 'dealer';
    } elseif (auth('retailer')->check()) {
        return 'retailer';
    } else {
        return false;
    }
}

