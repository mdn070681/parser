<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public static function getProductsBySale()
    {

        $products = Product::where('status', 1)->orderBy('sale', 'desc')->where('img', '!=', 'http://promotions/images/product.png')->paginate(51);

        return $products;

    }

}
