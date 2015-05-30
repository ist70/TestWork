<?php

namespace Test\Models;


class Order
{

    public $products = [];

    public function addProduct(Product $product)
    {
        $this->products[] = [
            'product' => $product,
            'isDiscounted' => 0,
        ];
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getCount()
    {
        return count($this->products);
    }

} 