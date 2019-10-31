<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Repositories\ProductInterface;
use App\Repositories\CategoryInterface;
use App\Http\Requests\ProductValidation;
use App\Http\Requests\ProductUpdateValidation;
use App\Http\Requests\QuantityCheck;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductInterface $productRepository, CategoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        if( auth()->user()->isAdmin() ){
            $products = $this->productRepository->getAllWithPaginate(10);
            return view('Admin.product', compact('products'));
        } else {
            $products = $this->productRepository->getSellerAllProduct( auth()->user()->id );
            return view('User.product', compact('products'));
        }
    }

    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        return view('User.productCreate', compact('categories'));
    }

    public function store(ProductValidation $request)
    {
        if ($file = $request->file('image')) {
            Storage::putFile('public', $file);
            $request->merge(['uplodedImage' => $request->image->hashName()]);
        }
        $product = $this->productRepository->store($request->all());
        return redirect()->route('product.index')->with('success','Successfully Created.');
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        return view('productDetails', compact('product'));
    }

    public function edit($id)
    {
        $categories = $this->categoryRepository->getAll();
        $product = $this->productRepository->getById($id, auth()->user()->id );
        return view('User.productEdit', compact('categories','product') );
    }

    public function update(ProductUpdateValidation $request, $id)
    {
        if ($file = $request->file('image')) {
            Storage::putFile('public', $file);
            $request->merge(['uplodedImage' => $request->image->hashName()]);
        }
        $product = $this->productRepository->update($id, $request->all() );
        return redirect()->route('product.edit', $id)->with('success','Successfully Updated.');
    }
	
    public function destroy(Product $product)
    {
        //
    }

    public function buy(QuantityCheck $request,$id)
    {
        $product = $this->productRepository->buy($id,$request->all());
        return redirect()->route('product.show',$id)->with('success','Successfully Buy.');
    }

}
