<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductInterface;

class FrontendController extends Controller
{
    private $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAllWithPaginateAvaliable(8);
        return view('welcome', compact('products'));
    }
}
