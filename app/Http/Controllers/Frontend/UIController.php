<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Models\Item;
use Illuminate\Http\Request;

class UIController extends Controller
{
    public function __construct(Item $item){
        $this->item = $item;
        view()->share(['item' => $this->item->all()]);
    }

    public function index(){
        return view('frontend.pages.content');
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
        return view('frontend.pages.directors', ['directors' => Director::all()]);
    }

    public function products(){
        return view('frontend.pages.products');
    }

    public function qualityAssurance(){
        return view('frontend.pages.quality-assurance');
    }

    public function gallery(){
        return view('frontend.pages.gallery', ['galleries' => allGallery()]);
    }

    public function newsEvent(){
        return view('frontend.pages.new-events');
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
