<?php

interface Vacancy
{
    public function setNewVacancy(Observer $observer);
    public function register(Observer $observer);
    public function unRegister(Observer $observer);
}