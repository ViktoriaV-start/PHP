<?php

class UniqueVacancy
{
    public string $name;
    public int $id;
    public string $company;
    public $date;


    public function __construct($name, $id, $company)
    {
        $this->name = $name;
        $this->id = $id;
        $this->company = $company;
        $this->date = date('m/d/Y h:i:s a', time());
        $this->addToVacancy($this->name);

    }

    private function addToVacancy($name) {

        switch ($name) {
            case 'programmerPHP':
                ProgrammerPHP::getInstance()->setNewVacancy($this);
                break;
            case 'designer':
                Designer::getInstance()->setNewVacancy($this);
                break;
        }
    }
}