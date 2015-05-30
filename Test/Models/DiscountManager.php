<?php

namespace Test\Models;


class DiscountManager
{

    protected $discounts = [];
    protected $order;

    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function addDiscount($discount)
    {
        $this->discounts[] = $discount;
    }

    public function getDiscount()
    {
        return $this->discounts;
    }

    public function doCalculation()
    {
        $sum = 0;
        foreach ($this->discounts as $discount) {
            $discount->setOrder($this->order);
            $sum += $discount->Calc();
        }
        return $sum;
    }

} 