<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'quantity', 'buyer_id', 'product_id'
    ];

    function user(){
        return $this->belongsTo(User::class, 'buyer_id', 'id');
     }

    function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


}
