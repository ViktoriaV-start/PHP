<?php

class Facebook implements IComponent
{

    protected $component;

    public function __construct(IComponent $component) {
        $this->component = $component;
    }


    public function operation()
    {
        echo "Facebook-рассылка; ";
        $this->component->operation();
    }


}