<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;
use JonnyW\PhantomJs\Client;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;

class SilpoParser extends Parser
{
    public function parser()
    {

        $url = [
            'https://silpo.ua/offers',
            'https://silpo.ua/offers?offset=30',
            'https://silpo.ua/offers?offset=60',
            'https://silpo.ua/offers?offset=90',
            'https://silpo.ua/offers?offset=120'
        ];

        foreach ($url as $u) {

            $title = shell_exec("phantomjs /home/motions/public_html/promotions/app/Parser/js/parser.js $u");
            $doc = PhpQuery::newDocument($title);

            foreach ($doc->find(".product-list li.normal") as $div) {
                $div = pq($div);

                $name = $div->find('.product-list__item-title')->text();

                $img = $div->find('.product-list__item-image img')->attr('src');

                $price_old = $div->find('.product-price__old')->text();

                if (empty($price_old)) {
                    $price_old = 0;
                }

                $price = (float)$price_old;
                $price = number_format($price, 2, '.', '');


                $price_dollar_sale = $div->find('.product-price__integer')->text();
                $price_cent_sale = $div->find('.product-price__fraction')->text();
                $price_sale = $price_dollar_sale + $price_cent_sale / 100;
                $price_sale = (float)$price_sale;
                $price_sale = number_format($price_sale, 2, '.', '');

                if (!empty($price_sale) && !empty($price) && $price != 0) {
                    $sale = ($price - $price_sale) / $price * 100;
                    $sale = ceil($sale);
                }

                $product = new Product();
                $product->name_action = 'Акции Сильпо';
                $product->shop_id = "2";
                $product->shop = '\images\silpo-small.png';
                $product->img = $img;
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
        }

        return true;
    }

    protected function SilpoShop($u, $start, $end)
    {

        if ($start < $end) {
            $sil = $this->parserShops($u);

            $name_action = $sil->find('.intro-title');

            $this->statusProductOff($name_action);

            foreach ($sil->find(".product-list li.normal") as $div) {

                $div = pq($div);

                $name = $div->find('.product-list__item-title')->text();

                $img = $div->find('.product-list__item-image img')->attr('href');

                $price_old = $div->find('.product-price__old')->text();

                if (empty($price_old)) {
                    $price_old = 0;
                }

                $price = (float)$price_old;
                $price = number_format($price, 2, '.', '');

                $price_dollar_sale = $div->find('.product-price__integer')->text();
                $price_cent_sale = $div->find('.product-price__fraction')->text();
                $price_sale = $price_dollar_sale + $price_cent_sale / 100;
                $price_sale = (float)$price_sale;
                $price_sale = number_format($price_sale, 2, '.', '');

                if (!empty($price_sale) && !empty($price) && $price != 0) {
                    $sale = ($price - $price_sale) / $price * 100;
                    $sale = ceil($sale);
                }

                $product = new Product();
                $product->name_action = $name_action;
                $product->shop_id = "2";
                $product->shop = '\images\silpo-small.png';
                $product->img = $img;
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

            $http = 'https://silpo.ua';
            $next1 = $sil->find('.pagination span.active')->next()->find('a')->attr('href');
            $url = $http . $next1;

            if (!empty($next1)) {
                $start++;
                $this->SilpoShop($url, $start, $end);
            }
        }
    }
}
