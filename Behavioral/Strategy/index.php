<?php

spl_autoload_register(function ($class) {
    include $class . '.php';
});

$order1 = new Order(1, 9855557755, 2555);
$order2 = new Order(2, 9163337733, 28100);
$order3 = new Order(3, 9164447744, 749);

echo $order1->payment(new Qiwi());
echo $order2->payment(new YandexMoney());
echo $order3->payment(new WebMoney());
echo $order1->payment(new Qiwi());
echo $order1->payment(new Qiwi());
