<?php

class programmerPHP implements Vacancy
{
    private static $instance = null;
    public array $allVacancies;
    public array $observers = [];

    use TSingletone;

    public function setNewVacancy($newVacancy) {
        $this->allVacancies[] = $newVacancy;
        $this->notifyObservers($newVacancy);
    }

    public function register(Observer $observer) {
        $this->observers[] = $observer;
    }
    public function unRegister(Observer $observer) {
        unset($this->observers[array_search($observer, $this->observers)]);
    }

    public function notifyObservers($newVacancy) {
        foreach ($this->observers as $item) {
            echo "<br>" . " Сообщение для " . $item->getName() .
                " - добавлена новая вакансия PHP-программист - компания " . $newVacancy->company
                . ", " . $newVacancy->date;
        }
    }
}