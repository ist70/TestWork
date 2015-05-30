<?php

namespace Test\Controllers;

use Test\Models\Product;
use Test\Models\Discount_Product;

class ProductAdmin
{

    private $sourses = ['A' => 1000, 'B' => 100,'C' => 40, 'D' => 600,'E' => 1500, 'F' => 1100];

    public function actionIndex()
    {
        $this->actionCreate()->actionSetConnection();
    }

    private  function actionCreate()
    {
        foreach ($this->sourses as $key => $value) {
            $object[$key] = new Product($key, $value);
        }
        return $this;
    }

    private function actionSetConnection()

    {
        $discount1 = new Discount_ProductSet();
        $discount1->setProductSet();
        $discount1->setDiscount(10);
        return $this;
    }

}