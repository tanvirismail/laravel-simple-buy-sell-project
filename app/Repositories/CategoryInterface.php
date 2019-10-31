<?php

namespace App\Repositories;

interface CategoryInterface
{
    public function getAllWithPaginate($count);

    public function getAll();
    
    public function getById($id);

    public function store(array $attributes);

    public function update($id,array $attributes);

    public function destroy($id);
}
