<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\UserInterface;
use App\Http\Requests\UserValidation;

class UserController extends Controller
{

    private $UserRepository;

    public function __construct(UserInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function buyers()
    {
        $buyers = $this->UserRepository->getAllBuyers();
        return view('Admin.buyersList', compact('buyers'));
    }

    public function buyerProduct($id)
    {
        $buyer = $this->UserRepository->getUserById($id);
        $products = $this->UserRepository->getBuyerAllProduct($id);
        return view('Admin.buyersProducts', compact('buyer', 'products'));
    }
    
    public function sellers()
    {
        $sellers = $this->UserRepository->getAllSellers();
        return view('Admin.sellersList', compact('sellers'));
    }

    public function sellersProduct($id)
    {
        $seller = $this->UserRepository->getUserById($id);
        $products = $this->UserRepository->getSellerAllProduct($id);
        return view('Admin.sellersProducts', compact('seller', 'products'));
    }

}
