<?php

interface IPaymentSystem
{
    public function paymentProcessing(Order $order);

}