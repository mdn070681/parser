<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;

use DB;

class AboutController extends Controller
{
    public function show()
    {
        if (view()->exists('about')) {

            $catalog = Catalog::all();
            return view('about')->withCatalog($catalog);
        }
        return view('index')->withTitle('View not found');
    }
}
