<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;

class VelmarketParser extends Parser
{
    public function parser()
    {
        $velmarket = $this->parserShops('http://velmart.ua/ru/actions/product-of-week?c=xarkov');
        $velmarket->find('h1 a')->remove();
        $name_action = $velmarket->find('h1')->text();

        $this->statusProductOff($name_action);

        foreach ($velmarket->find(".food .block") as $li) {
            $li = pq($li);

            $href_img = $li->find('img')->attr('src');
            $img = 'http://velmart.ua' . $href_img;

            $product = new Product();

            $product->name_action = $name_action;
            $product->shop_id = "6";
            $product->shop = '\images\velmart-small.png';
            $product->img = $img;

            $oldProduct = Product::where('img', $img)->first();

            if ($oldProduct) {
                $oldProduct->status = 1;
                $oldProduct->save();
            } else {
                $product->save();
            }
        }

        return true;
    }
}
