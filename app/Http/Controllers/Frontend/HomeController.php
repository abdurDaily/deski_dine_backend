<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //*HOME 
    public function home(){
        return view('index');
    }
    //* addToCart
    public function addToCart(){
        return view('frontend.addtocart');
    }
    //* checkout 
    public function checkout(){
        return view('frontend.checkout');
    }
}
