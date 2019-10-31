<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description', 
        'quantity', 
        'status', 
        'image',
        'seller_id'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

}
