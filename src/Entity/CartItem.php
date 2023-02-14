<?php

namespace App\Entity;

use App\Entity\Product;

class CartItem {
    public function __construct(
        public Product $product, 
        public int $amount,
    ) {}

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount(int $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    public function getProduct()
    {
        return $this->product;
    }

}