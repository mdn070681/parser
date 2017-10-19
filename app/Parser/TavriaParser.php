<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;

class TavriaParser extends Parser
{
    public function parser()
    {
        $this->Tavria();
        $this->TavriaSale();

    }

    protected function Tavria()
    {
        $tavria = $this->parserShops('http://landing.od.ua/?_ga=2.8491445.1699723088.1507105911-1206546573.1507105910');
        $name_action = $tavria->find('h1')->text();

        $this->statusProductOff($name_action);

        foreach ($tavria->find(".produkt_item") as $li) {
            $li = pq($li);

            $name = trim($li->find('.title')->text());

            $href_img = $li->find('img')->attr('src');
            $img = 'http://landing.od.ua/' . $href_img;

            $price = $li->find('.price span')->text();
            $li->find('.price span')->remove();
            $pos = strrpos($price, ",");
            $price_new = (int)substr($price, 0, $pos);
            $price_new_cop = stristr($price, ',');
            $pos = strrpos($price_new_cop, ' ');
            $price_new_cop = (int)substr($price_new_cop, 1, $pos);
            $price_sale = $price_new + $price_new_cop / 100;

            $price = $li->find('.price')->text();
            $pos = strrpos($price, ",");
            $price_old = (int)substr($price, 0, $pos);
            $price_old_cop = stristr($price, ',');
            $pos = strrpos($price_old_cop, ' ');
            $price_old_cop = (int)substr($price_old_cop, 1, $pos);
            if (empty($price_old) || empty($price_old_cop)) {
                $price_old = 0;
                $price_old_cop = 0;
            }
            $price = $price_old + $price_old_cop / 100;

            $price_sale = (float)$price_sale;
            $price_sale = number_format($price_sale, 2, '.', '');

            if (!empty($price_sale) && !empty($price) && $price != 0) {
                $sale = ($price - $price_sale) / $price * 100;
                $sale = ceil($sale);
            }
            $price = (float)$price;
            $price = number_format($price, 2, '.', '');

            $product = new Product();


            $product->name = $name;
            $product->name_action = $name_action;
            $product->shop_id = "7";
            $product->shop = '\images\tavria-small.png';
            $product->img = $img;
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

    protected function TavriaSale()
    {
        $tavria = $this->parserShops('http://www.tavriav.org/actions/sale/');
        $name_action = $tavria->find('h1')->text();

        $this->statusProductOff($name_action);

        foreach ($tavria->find("tbody tr") as $li) {
            $li = pq($li);

            $name = trim($li->find('td:first-child')->text());
            $price_sale = (float)$li->find('td:last-child')->text();
            $price = (float)$li->find('td:nth-child(2)')->text();

            if (!empty($price_sale) && !empty($price)) {
                $sale = ($price - $price_sale) / $price * 100;
                $sale = ceil($sale);
            }

            $product = new Product();

            $product->name = $name;
            $product->name_action = $name_action;
            $product->shop_id = "7";
            $product->shop = '\images\tavria-small.png';
            $product->img = 'http://promotions/images/product.png';
            if (empty($price)) {
                $price = null;
                $sale = 0;
            }
            $product->price = $price;
            $product->price_sale = $price_sale;
            $product->sale = $sale;

            $oldProduct = Product::where('name', $name)->first();

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
