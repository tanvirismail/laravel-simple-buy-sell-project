<?php
namespace App\Observers;


use App\Product;
use Illuminate\Support\Str;

class ProductObserver
{


    public function creating(Product $product)
    {
        $product->seller_id = auth()->user()->id;
    }
}