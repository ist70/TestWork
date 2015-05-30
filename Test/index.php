<?php

namespace Test;

use \Test\Models\Product;
use \Test\Models\Order;
use \Test\Models\DiscountProduct;
use Test\Models\DiscountCountProduct;
use Test\Models\DiscountDepositProduct;
use Test\Models\DiscountManager;
use Test\Models\Calculator;

require __DIR__ . '\Models\Product.php';
require __DIR__ . '\Models\Calculator.php';
require __DIR__ . '\Models\Order.php';
require __DIR__ . '\Models\Discount.php';
require __DIR__ . '\Models\DiscountProduct.php';
require __DIR__ . '\Models\DiscountDepositProduct.php';
require __DIR__ . '\Models\DiscountCountProduct.php';
require __DIR__ . '\Models\DiscountManager.php';


$products = ['A' => 1000, 'B' => 1000, 'C' => 40, 'D' => 600, 'E' => 1500,
    'F' => 1100, 'G' => 1600, 'K' => 100, 'L' => 100, 'M' => 100];
$productsSelect = ['A', 'B', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'K', 'L', 'M'];

foreach ($products as $name => $price) {
    $object[$name] = new Product($name, $price);
}

$discount1 = new DiscountProduct();
$discount1->setProductSet($object['A'], $object['B']);
$discount1->setDiscount(10);

$discount2 = new DiscountProduct();
$discount2->setProductSet($object['D'], $object['E']);
$discount2->setDiscount(5);

$discount3 = new DiscountProduct();
$discount3->setProductSet($object['E'], $object['F'], $object['G']);
$discount3->setDiscount(5);

$discount4 = new DiscountDepositProduct();
$discount4->setPrimaryProduct($object['A']);
$discount4->setDepositProduct($object['K']);
$discount4->setDepositProduct($object['L']);
$discount4->setDepositProduct($object['M']);
$discount4->setDiscount(5);

$discount5 = new DiscountCountProduct();
$discount5->addExeptionProduct($object['A']);
$discount5->addExeptionProduct($object['C']);
$discount5->addCountProduct(3, 5);
$discount5->addCountProduct(4, 10);
$discount5->addCountProduct(5, 20);

$order = new Order();
foreach ($productsSelect as $name) {
    $order->addProduct($object[$name]);
}
$manager_dc = new DiscountManager();
$manager_dc->addDiscount($discount1);
$manager_dc->addDiscount($discount2);
$manager_dc->addDiscount($discount3);
$manager_dc->addDiscount($discount4);
$manager_dc->addDiscount($discount5);

$calculator = new Calculator();
$calculator->setOrder($order);
$calculator->setDiscountManager($manager_dc);
$summa = $calculator->doCalculation();

echo "Итого: " . $summa;
?>