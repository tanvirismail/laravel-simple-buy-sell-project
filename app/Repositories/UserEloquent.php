<?php
namespace App\Repositories;

use App\User;
use App\Transaction;
use App\Product;
use App\Repositories\UserInterface;

class UserEloquent implements UserInterface
{


    private $user;
    private $transaction;
    private $product;

    public function __construct(User $user, Transaction $transaction, Product $product)
    {
        $this->user = $user;
        $this->transaction = $transaction;
        $this->product = $product;
    }


    public function getAllBuyers()
    {
        return $this->transaction
        ->whereHas('user', function ($query){$query->where('admin', 'false');})
        ->with('user')
        ->select(['buyer_id'])
        ->distinct()
        ->orderBy('buyer_id', 'desc')
        ->paginate(10);
    }

    public function getAllSellers()
    {
        return $this->user
        ->where('admin', 'false')
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    public function getUserById($id)
    {
        return $this->user->where('admin', 'false')->findOrFail($id);
    }

    public function getBuyerAllProduct($id)
    {
        return $this->transaction
        ->whereHas('user', function ($query){$query->where('admin', 'false');})
        ->with(['products','products.category'])
        ->where('buyer_id', $id)
        ->paginate(10);
    }

    public function getSellerAllProduct($id)
    {
        return $this->product
        ->with('category')
        ->where('seller_id', $id)
        ->paginate(10);
    }

}