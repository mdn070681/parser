<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shops;
use App\Product;
use App\Catalog;
use App\Parser\ShopsParser;
use App\Http\Controllers\MailSetting;

class ShopsParserController extends Controller
{
    /**
     * @param Request $request
     */
    public function shopsParser(Request $request)
    {
        $input = array_keys($request->except('_token'));

        if (!empty($input)) {
            $shop = new ShopsParser();

            foreach ($input as $item) {
                $shops[] = Shops::where('id', $item)->pluck('method');
            }

            foreach ($shops as $item) {
                $func = $item[0];
                $shop->$func();
            }
        }

        $data = Product::where('category_id', null)->where('status', '=', 1)->take(50)->get();
        $catalog = Catalog::all();
        $shops = Shops::all();
        return view('home')->withData($data)->withCatalog($catalog)->withShops($shops);
    }

    public static function cronParser()
    {
        $shop = new ShopsParser();
        $atb = $shop->AtbParser();
        $silpo = $shop->SilpoParser();
        $klass = $shop->KlassParser();
        $posad = $shop->PosadParser();
        $brusnichka = $shop->BrusnichkaParser();
        $velmarket = $shop->VelmarketParser();
        $tavria = $shop->TavriaParser();
        $okwine = $shop->OkwineParser();
        $antoshka = $shop->AntoshkaParser();

//        if ($atb && $silpo && $klass && $posad && $tavria && $brusnichka && $velmarket && $okwine && $antoshka) {
//
//        }
    }
}
