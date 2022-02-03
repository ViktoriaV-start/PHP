<?php

class User implements Observer
{
    protected string $name;
    protected string $mail;
    protected int $lengthOfService;

    public function __construct(string $name, string $mail, string $lengthOfService)
    {
        $this->name = $name;
        $this->mail = $mail;
        $this->lengthOfService = $lengthOfService;
    }

    public function getName() {
        return $this->name;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getLengthOfService() {
        return $this->lengthOfService;
    }

    public function notify($vacancyName)
    {
        switch ($vacancyName) {
            case 'programmerPHP':
                ProgrammerPHP::getInstance()->register($this);
                break;
            case 'designer':
                Designer::getInstance()->register($this);
                break;
        }
    }

    public function unNotify($vacancyName)
    {
        switch ($vacancyName) {
            case 'programmerPHP':
                ProgrammerPHP::getInstance()->unRegister($this);
                break;
            case 'designer':
                Designer::getInstance()->unRegister($this);
                break;
        }
    }
}