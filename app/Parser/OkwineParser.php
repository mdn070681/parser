<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;

class OkwineParser extends Parser
{
    public function parser()
    {
        $url = 'https://okwine.ua/action.html';
        $start = 0;
        $end = 100;

        $name_action = 'Акции OKwine';
        $this->statusProductOff($name_action);

        $this->OkwineParser($url, $start, $end);

        return true;
    }

    protected function OkwineParser($url, $start, $end)
    {
        if ($start < $end) {

            $okwine = $this->parserShops($url);
            $name_action = 'Акции OKwine';

            foreach ($okwine->find(".block_product ") as $div) {

                $div = pq($div);

                $str = $div->find('.product-name a')->text();
                $name = substr($str, 0, strpos($str, '/'));
                $desc = str_replace('/', '', substr($str, strpos($str, '/')));
                if (empty($desc)) {
                    $desc = null;
                }

                $img = $div->find('img')->attr('src');

                $price_sale = (float)$div->find('.special-price span')->text();
                $price = (float)$div->find('.old-price span')->text();

                $price_sale = (float)$price_sale;
                $price_sale = number_format($price_sale, 2, '.', '');

                if (!empty($price_sale) && !empty($price) && $price != 0) {
                    $sale = ($price - $price_sale) / $price * 100;
                    $sale = ceil($sale);
                }

                $price = (float)$price;
                $price = number_format($price, 2, '.', '');

                $product = new Product();
                $product->name_action = $name_action;
                $product->shop_id = "8";
                $product->shop = '\images\okwine-small.png';
                $product->img = $img;
                $product->description = $desc;
                $product->name = $name;
                if (empty($price)) {
                    $price = null;
                    $sale = 0;
                }
                $product->price = $price;
                $product->price_sale = $price_sale;
                $product->sale = $sale;

                $oldProduct = Product::where('img', $img)->first();

                if ($oldProduct) {
                    $oldProduct->status = 1;
                    $oldProduct->save();
                } else {
                    $product->save();
                }
            }

            $http = 'https://okwine.ua';
            $next1 = $okwine->find('.pagination .pagination-active')->next()->find('a')->attr('href');
            $url = $http . $next1;

            if (!empty($next1)) {
                $start++;
                $this->OkwineParser($url, $start, $end);
            }
        }
    }
}
