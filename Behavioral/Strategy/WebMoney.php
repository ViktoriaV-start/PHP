<?php

class WebMoney implements IPaymentSystem
{

    public function paymentProcessing(Order $order)
    {
        $order->payed = true;
        return "WebMoney оплата: " . $order->orderPrice . " руб, телефон " . $order->phone . "<br>";
    }
}