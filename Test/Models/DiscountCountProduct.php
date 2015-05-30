<?php

namespace Test\Models;


class DiscountCountProduct
    extends Discount
{
    protected $discountRule = [];
    protected $exceptedProducts = [];

    public function addExeptionProduct(Product $exeptionObject)
    {
        $this->exceptedProducts[] = $exeptionObject;
    }

    public function addCountProduct($count, $discount)
    {
        $this->discountRule[$count] = 1 - $discount / 100;
    }

    public function Calc()
    {
        $sum = 0;
        $cnt = 0;
        $products = &$this->order->products;
        foreach ($products as &$product) {
            if (!in_array($product['product'], $this->exceptedProducts) && $product['isDiscounted'] == 0) {
                $sum += $product['product']->getPrice();
                $product['isDiscounted'] = 1;
                $cnt++;
            }
        }
        if (array_key_exists($cnt, $this->discountRule)) {
            $sum *= $this->discountRule[$cnt];
        }
        return $sum;
    }
} 