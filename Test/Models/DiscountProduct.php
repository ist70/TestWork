<?php

use \Test\Models\Product;
use \Test\Models\Discount;

class DiscountProduct
    extends Discount
{
    protected $productsSet = [];

    public function setProductSet(Product $pr1, Product $pr2, Product $pr3 = null)
    {
        $this->productsSet = func_get_args();
    }
    public function getProductSet()
    {
        return $this->productSet;
    }
    public function doCalculation()
    {
        $sum = 0;
        $productsOrder = &$this->order->products;
        //For each pair go recursively
        $sum = $this->doRecursive($productsOrder, $sum);
        return $sum;
    }
    private  function doRecursive(&$productsOrder, $sum) {
        $discountProducts = array();
        foreach($this->productsSet as $productSet) {
            foreach($productsOrder as &$productOrder) {
                if($productOrder['product'] == $productSet && $productOrder['isDiscounted'] == 0) {
                    $discountProducts[] = &$productOrder;
                    break;
                }
            }
        }
        if(count($discountProducts) == count($this->productsSet)) {
            foreach($discountProducts as &$discountProduct) {
                $discountProduct['isDiscounted'] = 1;
                $sum += $discountProduct['product']->getPrice();
            }
            return $this->doRecursive($productsOrder, $sum);
        }
        return $sum * $this->getDiscount();
    }
}