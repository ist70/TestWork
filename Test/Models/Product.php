<?php

namespace Test\Models;

class Product {

    public $objectName;
    public $objectPrice;

    public function __construct($object, $price)
    {
        $this->objectName = $object;
        $this->objectPrice = $price;
    }
} 