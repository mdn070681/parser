<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;

class KlassParser extends Parser
{
    public function parser()
    {
       $this->parserTen();
       $this->parserTheme();
    }

    protected function parserTen()
    {
        $klass = $this->parserShops('http://www.klass.com.ua/catalog.html?cat_id=16');

        $name_action = $klass->find('#tttt strong')->text();

        $this->statusProductOff($name_action);

        foreach ($klass->find("#goods td[valign='top']") as $li) {
            $li = pq($li);

            $name = trim($li->find('.cmlt_1')->text());

            $href_img = $li->find('.img')->attr('style');
            $href = stristr($href_img, 'gallery');
            $pos = strrpos($href, ')');
            $img = 'http://www.klass.com.ua/' . substr($href, 0, $pos);

            $price_old = $li->find('.old_price_through')->text();
            $price_old_cop = $li->find('.old_price_kop')->text();
            $price = $price_old + $price_old_cop / 100;

            $price_new_cop = $li->find('.price_kop')->text();
            $li->find('.new_price>*')->remove();
            $price_new = $li->find('.new_price')->text();
            $price_sale = $price_new + $price_new_cop / 100;
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
            $product->shop_id = "3";
            $product->shop = '\images\klass-small.png';
            $product->img = $img;
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

    protected function parserTheme()
    {
        $klass = $this->parserShops('http://www.klass.com.ua/catalog.html?cat_id=43');

        $shop = '\images\klass-small.png';
        $name_action = $klass->find('#tttt strong')->text();

        $this->statusProductOff($name_action);

        foreach ($klass->find(".tttt tbody img") as $li) {
            $li = pq($li);
            $img = $li->attr('src');

            $product = new Product();

            $product->name_action = $name_action;
            $product->shop_id = "3";
            $product->shop = $shop;
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
