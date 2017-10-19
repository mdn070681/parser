<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Catalog;
use App\Shops;

class CatalogController extends Controller
{
    public function catalog(Request $request)
    {
        $input = $request->except('_token');
        $arr = array_values($input);

        for($i = 0; $i < count($arr); $i++){
            if(!($i%2)){
                $id[] = $arr[$i];
            }else{
                $catalogId[] = $arr[$i];
            }
        }

        for($j = 0; $j < count($id); $j++){
            for($k = 0; $k < count($catalogId); $k++){
                if($j === $k){
                    if($catalogId[$k] == 0){
                        DB::table('products')
                            ->where('id', $id[$j])
                            ->update(['category_id' => null]);
                    }else{
                        DB::table('products')
                            ->where('id', $id[$j])
                            ->update(['category_id' => $catalogId[$k]]);
                    }
                }
            }
        }

        $shops = Shops::all();
        $data = Product::where('category_id', null)->where('status', '=', 1)->take(100)->get();
        $catalog = Catalog::all();
        return view('home')->withData($data)->withCatalog($catalog)->withShops($shops);

    }

}