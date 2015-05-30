<?php

namespace Test\Models;


class DiscountProduct
    extends Discount
{
    protected $productsSet = [];
    protected $productSet;

    public function setProductSet(Product $pr1, Product $pr2, Product $pr3 = null)
    {
        $this->productsSet = func_get_args();
    }

    public function getProductSet()
    {
        return $this->productSet;
    }

    public function Calc()
    {
        $sum = 0;
        $productsOrder = &$this->order->products;
        $sum = $this->repitCalc($productsOrder, $sum);
        return $sum;
    }

    private function repitCalc(&$productsOrder, $sum)
    {
        $discountProducts = [];
        foreach ($this->productsSet as $productSet) {
            foreach ($productsOrder as &$productOrder) {
                if ($productOrder['product'] == $productSet && $productOrder['isDiscounted'] == 0) {
                    $discountProducts[] = &$productOrder;
                    break;
                }
            }
        }
        if (count($discountProducts) == count($this->productsSet)) {
            foreach ($discountProducts as &$discountProduct) {
                $discountProduct['isDiscounted'] = 1;
                $sum += $discountProduct['product']->getPrice();
            }
            return $this->repitCalc($productsOrder, $sum);
        }
        return $sum * $this->getDiscount();
    }
} 