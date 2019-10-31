<?php
namespace App\Repositories;

use App\Category;
use App\Repositories\CategoryInterface;

class CategoryEloquent implements CategoryInterface
{

    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function getAll()
    {
        return $this->category->all();
    }

    public function getAllWithPaginate($count)
    {
        return $this->category->orderBy('id', 'desc')->paginate($count);
    }

    public function getById($id)
    {
        return $this->category->findOrFail($id);
    }

    public function store(array $attributes)
    {
        return $this->category->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $category = $this->category->findOrFail($id);
        $category->update($attributes);
        return $category;
    }

    public function destroy($id)
    {
        $this->category->findOrFail($id)->delete();
        return true;
    }
}