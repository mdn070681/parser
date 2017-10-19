<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;

class BrusnichkaParser extends Parser
{
        public function parser()
        {
            $brusnichka = $this->parserShops('http://brusnichka.com.ua:81/pokupatelyam/aktsii/');
            $name_action = 'Лучшая цена';

            $this->statusProductOff($name_action);

            foreach ($brusnichka->find(".weekly-promo-item") as $li) {
                $li = pq($li);

                $name = trim($li->find('.name span')->text());
                $li->find('.name span')->remove();
                $desc = $li->find('.name')->text();

                $href_img = $li->find('.img')->attr('style');
                $href = stristr($href_img, '/upload');
                $pos = strrpos($href, "'");
                $img = 'https://brusnichka.com.ua' . substr($href, 0, $pos);

                $price_old_cop = $li->find('.price__old .coins')->text();
                $li->find('.price__old .coins')->remove();
                $price_old = $li->find('.price__old')->text();

                if (empty($price_old)) {
                    $price_old = 0;
                }

                if (empty($price_old_cop)) {
                    $price_old_cop = 0;
                }
                $price = $price_old + $price_old_cop / 100;

                $price_new_cop = $li->find('.price__new .coins')->text();
                $li->find('.price__new .coins')->remove();
                $price_new = $li->find('.price__new')->text();
                $price_sale = $price_new + $price_new_cop / 100;


                $price_sale = (float)$price_sale;
                $price_sale = number_format($price_sale, 2, '.', '');
                $sale = $li->find('.price__yellow .price__discount')->text();

                if(empty($sale)){
                    $sale = 0;
                }else{
                    $sale = substr((int)$sale, 1);
                }

                $price = (float)$price;
                $price = number_format($price, 2, '.', '');

                $product = new Product();

                $product->name = $name;
                $product->name_action = $name_action;
                $product->shop_id = "5";
                $product->shop = '\images\brusnichka-small.png';
                $product->img = $img;
                $product->description = $desc;
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

            return true;
        }
}
