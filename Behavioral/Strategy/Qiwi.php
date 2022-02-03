<?php

class Qiwi implements IPaymentSystem
{
    public function paymentProcessing(Order $order)
    {
        $order->payed = true;
        return "Qiwi оплата: " . $order->orderPrice . " руб, телефон " . $order->phone . "<br>";
    }
}