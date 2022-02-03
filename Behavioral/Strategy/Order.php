<?php

class Order
{
    public int $orderNumber;
    public int $phone;
    public int $orderPrice;
    public bool $payed = false;


    public function __construct(int $orderNumber, string $phone, int $orderPrice)
    {
        $this->orderNumber = $orderNumber;
        $this->phone = $phone;
        $this->orderPrice = $orderPrice;
    }

    public function payment(IPaymentSystem $system) {
        if ($this->payed === false) {
            return $system->paymentProcessing($this);
        } else {
            return "Оплата заказа № " . $this->orderNumber . " произведена";
        }
    }

}