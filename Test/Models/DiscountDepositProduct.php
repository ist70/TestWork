<?php

namespace Test\Models;


class DiscountDepositProduct
    extends Discount
{

    protected $main_product = null;
    protected $dependent_products = [];

    public function setPrimaryProduct(Product $object)
    {
        $this->main_product = $object;
    }

    public function setDepositProduct(Product $object)
    {
        $this->dependent_products[] = $object;
    }

    public function Calc()
    {
        $sum = 0;
        $main_product = false;
        //test main main product and set dependent products
        if (!is_object($this->main_product) || count($this->dependent_products) == 0) {
            return $sum;
        }
        $products = &$this->order->products;
        //find main product into order
        foreach ($products as $product) {
            if ($product['product'] == $this->main_product) {
                $main_product = true;
            }
        }
        reset($products);
        if (!$main_product) return $sum;
        //find dependent products
        foreach ($products as &$product) {
            if (in_array($product['product'], $this->dependent_products) && $product['isDiscounted'] == 0) {
                $sum += $product['product']->getPrice();
                $product['isDiscounted'] = 1;
            }
        }
        return $sum * $this->getDiscount();
    }
} 