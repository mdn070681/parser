<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Cookie\CookieJar;
use App\Catalog;

class ContactController extends Controller
{
    public function show()
    {
        $catalog = Catalog::all();
        return view('contact')->withCatalog($catalog)->withTitle('promotions | contact');
    }

}
