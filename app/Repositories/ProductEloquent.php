<?php
namespace App\Repositories;

use App\Product;
use App\Transaction;
use App\CategoryProduct;
use App\Repositories\ProductInterface;
use DB;

class ProductEloquent implements ProductInterface
{

    /**
     * @var Product
     */
    private $product;
    private $transaction;

    public function __construct(Product $product, Transaction $transaction)
    {
        $this->product = $product;
        $this->transaction = $transaction;

    }


    public function getAllWithPaginateAvaliable($count)
    {
        return $this->product->where('status','available')->orderBy('id', 'desc')->paginate($count);
    }

    public function getAllWithPaginate($count)
    {
        return $this->product->orderBy('id', 'desc')->paginate($count);
    }

    public function getById($id,$user_id=false)
    {
        if($user_id){
            $this->product = $this->product->where('seller_id',$user_id);
        }
        return $this->product->findOrFail($id);
    }

    public function store(array $data)
    {
        $product = $this->product->create([
            "name" => $data['name'],
            "description" => $data['description'],
            "quantity" => $data['quantity'],
            "status" => $data['status'],
            'image' => $data['uplodedImage']
        ]);

        foreach($data['category'] as $value){
            DB::table('category_product')->insert([
                'category_id'=>$value,
                'product_id'=>$product->id
            ]);
        }
        return $product;
    }

    public function update($id, array $attributes)
    {
        $product = $this->product->where('seller_id', auth()->user()->id)->findOrFail($id);
    
        $data = [
            "name" => $attributes['name'],
            "description" => $attributes['description'],
            "quantity" => $attributes['quantity'],
            "status" => $attributes['status']
        ];
        if(@$attributes['uplodedImage']){
            $data['image'] = @$attributes['uplodedImage'];
        }
        
        $product->update($data);

        foreach($attributes['category'] as $value){
            CategoryProduct::updateOrCreate(
                ['category_id'=>$value,'product_id'=>$product->id],
                ['category_id'=>$value,'product_id'=>$product->id]
            );
        }
        return $product;

    }

    public function destroy($id)
    {
        $this->product->findOrFail($id)->delete();
        return true;
    }

    public function getSellerAllProduct($id)
    {
        return $this->product
        ->with('category')
        ->where('seller_id', $id)
        ->paginate(10);
    }

    public function buy($id, array $attributes)
    {
        
        $product = $this->product
        ->where([['id','=',$id], ['quantity','>=', $attributes['quantity']  ]])
        ->whereNotIn('seller_id', [ auth()->user()->id ])
        ->firstOrFail();

        $transaction = $this->transaction->create([
            "quantity" => $attributes['quantity'],
            "buyer_id" => auth()->user()->id,
            'product_id' => $id
        ]);

        $product->decrement('quantity', $attributes['quantity']);;

        return $transaction;
    }

}