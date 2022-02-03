<?php

class Designer implements Vacancy
{

    private static $instance = null;
    public array $allVacancies;
    public array $observers;

    use TSingletone;

    function setNewVacancy($newVacancy)
    {
        $this->allVacancies[] = $newVacancy;

        foreach ($this->observers as $item) {
            echo "<br>" . " Сообщение для " . $item->getName() .
                " - добавлена новая вакансия Дизайнер - компания " . $newVacancy->company
                . ", " . $newVacancy->date;
        }
    }

    public function register(Observer $observer) {
        $this->observers[] = $observer;
    }
    public function unRegister(Observer $observer) {
        unset($this->observers[array_search($observer, $this->observers)]);
    }
}