<?php

namespace Test\Controllers;

use Test\Models\Product;
use Test\Models\Discount_Product;

class ProductAdmin
{
    public $productsSelect = ['A', 'B', 'A', 'B', 'C', 'D', 'E', 'F', 'G'];

    public function actionIndex()
    {
        $this->actionCreate()->actionSetConnection();
    }

    private function actionCreate()
    {
        return Product::index();
    }

    private function actionSetConnection()

    {
        $discount2 = new Discount_Product();
        $discount2->setDiscountProduct2($this->object, 'A', 'B', 10);
        return $this;
    }

    public function actionOrder()
    {
        $productOrder = new Order($this->productsSelect);
        foreach ($this->productsSelect as $product) {
            $productOrder->push($product);
        }
    }

}