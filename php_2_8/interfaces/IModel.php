<?php
//Интерфейс не содержит полей, только публичные методы без реализации
// Это описание архитектуры приложения с публичными методами и с указанием параметров
namespace app\interfaces;

interface IModel
{
    public function  getOne($id);
    public function  getAll();

}


