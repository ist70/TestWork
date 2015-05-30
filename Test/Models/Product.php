<?php

namespace Test\Models;

class Product
{

    public $objectName;
    public $objectPrice;

    public function __construct($name, $price)
    {
            $this->objectName = $name;
            $this->objectPrice = $price;
    }

    public function getName()
    {
        return $this->objectName;
    }

    public function getPrice()
    {
        return $this->objectPrice;
    }
} 