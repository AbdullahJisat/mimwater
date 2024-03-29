<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Client;
use App\Models\ClientReview;
use App\Models\Department;
use App\Models\Director;
use App\Models\Item;
use Illuminate\Http\Request;

class UIController extends Controller
{
    public function __construct(){
        view()->share(['items' => allItem(), 'clientReviews' => ClientReview::with('designation')->get(), 'clients' => Client::all()]);
    }

    public function index(){
        $about = About::latest()->first();;
        return view('frontend.pages.content',compact('about'));
    }

    public function overview(){
        return view('frontend.pages.overview');
    }

    public function ceoMsg(){
        return view('frontend.pages.ceo-message');
    }

    public function chiefMsg(){
        return view('frontend.pages.chief-message');
    }

    public function directors(){
        return view('frontend.pages.directors', ['departments' => Department::with('directors', 'directors.designation')->get()]);
    }

    public function products(){
        return view('frontend.pages.products', ['items' => allItem()]);
    }

    public function qualityAssurance(){
        return view('frontend.pages.quality-assurance');
    }

    public function gallery(){
        return view('frontend.pages.gallery', ['galleries' => allGallery()]);
    }

    public function productionFacilities(){
        return view('frontend.pages.production-facilities', ['productionFacilities' => allProductionFacilities()]);
    }

    public function newsEvent(){
        return view('frontend.pages.news-events', ['newsEvents' => allNewsEvents()]);
    }

    public function career(){
        return view('frontend.pages.career');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function invoice(){
        return view('backend.pages.stock-item.invoice');
    }

}
