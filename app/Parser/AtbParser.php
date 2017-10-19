<?php

namespace App\Parser;

use App\Parser\Parser;
use phpQuery;
use App\Product;

class AtbParser extends Parser
{
    public function parser()
    {
        $url = [
            'http://www.atbmarket.com/ru/hot/akcii/economy/',
            'http://www.atbmarket.com/ru/hot/akcii/7day/'
        ];

        foreach ($url as $u) {
            $atb = $this->parserShops($u);

            $name_action = $atb->find("title")->text();

            $this->statusProductOff($name_action);

            foreach ($atb->find(".promo_list li") as $li) {
                $li = pq($li);

                $desc = $li->find('.promo_info_text span')->text();
                $li->find('.promo_info_text span')->remove();
                $name = trim($li->find('.promo_info_text')->text());

                $href_img = $li->find('.promo_image_wrap img')->attr('src');
                $href_img = str_replace('_295_235_f', '', $href_img);
                $img = 'http://www.atbmarket.com/' . $href_img;

                $price = $li->find('.promo_old_price')->text();
                $price = (float)$price;
                $price = number_format($price, 2, '.', '');
                $li->find('.promo_price .currency')->remove();
                $price_cent = $li->find('.promo_price span')->html();
                $li->find('.promo_price span')->remove();
                $price_dollar = $li->find('.promo_price')->html();
                $price_sale = $price_dollar + $price_cent / 100;
                $price_sale = (float)$price_sale;
                $price_sale = number_format($price_sale, 2, '.', '');

                if (!empty($price_sale) && !empty($price) && $price != 0) {
                    $sale = ($price - $price_sale) / $price * 100;
                    $sale = ceil($sale);
                }

                $product = new Product();

                $product->name = $name;
                $product->name_action = $name_action;
                $product->shop_id = "1";
                $product->shop = '\images\atb-small.png';
                $product->img = $img;
                $product->description = $desc;
                if (empty($price) || $price == 0) {
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

}
