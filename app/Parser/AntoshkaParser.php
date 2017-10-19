<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;

class AntoshkaParser extends Parser
{
    public function parser()
    {
        $antoshka = $this->parserShops('http://antoshka.ua/actions/offers/online');
        $name_action = 'Акции и скидки Antoshka';

        $this->statusProductOff($name_action);

        foreach ($antoshka->find(".offer-list__item") as $li) {
            $li = pq($li);

            $name = trim($li->find('.offer-title')->text());
            $desc = $li->find('.offer-description')->text();
            $img = $li->find('img')->attr('src');

            $li->find('.special-price .price span')->remove();
            $price_sale = trim($li->find('.special-price .price')->html());
            $price_sale = str_replace(",", '.', $price_sale);
            $price_sale = preg_replace("/[^x\d|*\.]/", "", $price_sale);
            $price = str_replace(",", '.', str_replace('грн.', '', trim($li->find('.old-price .price')->text())));
            $price = preg_replace("/[^x\d|*\.]/", "", $price);

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
            $product->description = $desc;
            $product->name_action = $name_action;
            $product->shop_id = "9";
            $product->shop = '\images\antoshka-small.png';
            $product->category_id = '14';
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
}
