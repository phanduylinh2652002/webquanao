<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class PageController extends Controller
{
    //
    public function getProduct(){
        $products = Product::join('categories', 'categories.category_id', 'products.category_id')
        ->select(
            'products.product_id',
            'products.product_name',
            'products.product_image',
            'products.product_price',
            'products.product_discount',
            'categories.category_gender'
        )
        ->limit(10)->get();
        return view('frontend.homepage', compact('products'));
    }
}
