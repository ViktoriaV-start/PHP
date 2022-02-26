<?php

class YandexMoney implements IPaymentSystem
{

    public function paymentProcessing(Order $order)
    {
        $order->payed = true;
        return "ЯндексДеньги оплата: " . $order->orderPrice . " руб, телефон " . $order->phone . "<br>";
    }
}