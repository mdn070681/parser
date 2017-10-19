<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;

class PosadParser extends Parser
{
    public function parser()
    {
        $url = [
            'http://posad.com.ua/goryachee_predlogenie/',
            'http://posad.com.ua/specials/'
        ];

        foreach ($url as $u) {
            $posad = $this->parserShops($u);
            $name_action = $posad->find(".entry-title")->text();
            $this->statusProductOff($name_action);

            foreach ($posad->find(".ngg-galleryoverview > div") as $li) {
                $li = pq($li);

                $img = $li->find('img')->attr('src');

                $product = new Product();

                $product->name_action = $name_action;
                $product->shop_id = "4";
                $product->shop = '\images\posad-small.png';
                $product->img = $img;

                $oldProduct = Product::where('img', $img)->first();

                if ($oldProduct) {
                    $oldProduct->status = 1;
                    $oldProduct->save();
                } else {
                    $product->save();
                }
            }
        }

        return true;
    }
}
