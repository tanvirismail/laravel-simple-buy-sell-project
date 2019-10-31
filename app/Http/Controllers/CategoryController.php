<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryValidation;

class CategoryController extends Controller
{

    private $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllWithPaginate(10);
        return view('Admin.category', compact('categories'));
    }

    public function create()
    {
        return view('Admin.categoryCreate');
    }

    public function store(CategoryValidation $request)
    {
        $category = $this->categoryRepository->store($request->all());
        return redirect()->route('category')->with('success','Successfully Created.');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->getById($id);
        return view('Admin.categoryEdit', compact('category') );
    }

    public function update(CategoryValidation $request, $id)
    {
        $category = $this->categoryRepository->update($id, $request->all());
        return redirect()->back()->with('success', 'Successfully Updated.');
    }

    public function destroy($id)
    {
        $this->categoryRepository->destroy($id);
        return redirect()->back()->with('success','Successfully Deleted.');
    }
}
