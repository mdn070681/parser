<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Catalog;
use DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $text = 'Sorry, but nothing found.';
        $arr = array_keys($request->except('_token', 'category'));

        $data = Product::where('status', 1);
        $flag = true;

        foreach($arr as $var){
            if($flag){
                $data =  $data->where('category_id', $var);
                $flag = false;
            }else{
                $data = $data->orWhere('category_id', '=', $var);
            }
        }
        $data = $data->get();
        $catalog = Catalog::all();
        $var = true;

        if($arr){
            if(empty($data[0])){
                return view('index')->withText($text)->withCatalog($catalog)->withTitle('promotions');
            }else{
                $var = false;
                return view('index')->withData($data)->withCatalog($catalog)->withVar($var)->withTitle('promotions');
            }
        }else{
            return view('index')->withText($text)->withCatalog($catalog)->withTitle('promotions');
        }

    }
}
