<?php

class Sms implements IComponent
{
    protected $component;

    public function __construct(IComponent $component) {
        $this->component = $component;
    }

    public function operation()
    {
        echo "SMS-рассылка; ";
        $this->component->operation();
    }

}