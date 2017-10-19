<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Catalog;
use App\Shops;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Product::where('category_id', null)->where('status', '=', 1)->take(50)->get();
        $catalog = Catalog::all();
        $shops = Shops::all();
        return view('home')->withData($data)->withCatalog($catalog)->withShops($shops);
    }
}
