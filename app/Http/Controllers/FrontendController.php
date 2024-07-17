<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function Home()
    {
        return view('frontend.Home');
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function shop()
    {
        $products=Product::all();
        return view('frontend.shop',compact('products'));
    }
    public function unauthorized_acess()
    {
        return view('frontend.unauthorized_access');
    }

}
