<?php

declare(strict_types = 1);

$shoppingCart1 = [
    ['product' => 'Телефон', 'price' => 1200],
    ['product' => 'Наушники', 'price' => 800],
    ['product' => 'Ноутбук', 'price' => 1500],
    ['product' => 'Телевизор', 'price' => 999],
];

$shoppingCart2 = [
    ['product' => 'Хлеб', 'price' => 30],
    ['product' => 'Колбаса', 'price' => 100],
    ['product' => 'Лук', 'price' => 2],
    ['product' => 'Редис', 'price' => 6],
];

function calculatePrice(array $arr): float {
    $getsDiscount1 = false;
    $getsDiscount2 = false;
    $sum = 0;
    $discount = 0;

    if (count($arr) > 3) {
        $getsDiscount2 = true;
    }

    foreach($arr as $item) {
        if (isset($item['price'])) {
            // Умножаю на 100, чтобы посчитать сумму в копейках и избежать потер точности во float
            $sum += $item['price'] * 100;
            if ($item['price'] > 1000) {
                $getsDiscount1 = true;
            }
        }
    }

    if ($getsDiscount1) {
        $discount = $sum / 10;
    }
    if ($getsDiscount2 && !$getsDiscount1) {
        $discount = $sum / 20;
    }

    // Считаю с учётом скидки и делю на 100, чтобы получить сумму в рублях
    return round(($sum - $discount) / 100, 2, 7);
}