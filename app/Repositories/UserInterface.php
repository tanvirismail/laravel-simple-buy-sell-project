<?php

namespace App\Repositories;

interface UserInterface
{
    public function getAllBuyers();
    public function getAllSellers();

    public function getUserById($id);
    public function getBuyerAllProduct($id);
    public function getSellerAllProduct($id);
}
