<?php
//Интерфейс не содержит полей, только публичные методы без реализации
// Это описание архитектуры приложения с публичными методами и с указанием параметров
namespace app\interfaces;

interface IModel
{
    public static function  getOne($id);
    public static function  getAll();
    public static function  getTableName();
}