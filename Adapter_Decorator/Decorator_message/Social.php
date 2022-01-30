<?php

class Social implements IComponent
{
    protected $component;

    public function __construct(IComponent $component) {
        $this->component = $component;
    }

    public function operation()
    {
        echo "Social-рассылка; ";
        $this->component->operation();
    }

}