<?php

namespace App\Repositories;

interface ProductInterface
{
    public function getAllWithPaginateAvaliable($count);

    public function getAllWithPaginate($count);

    public function getById($id,$user_id=false);
    
    public function getSellerAllProduct($id);

    public function store(array $attributes);

    public function update($id,array $attributes);

    public function destroy($id);

    public function buy($id,array $attributes);
}
