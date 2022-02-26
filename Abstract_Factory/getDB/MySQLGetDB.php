<?php

class MySQLGetDB extends GetDB
{
    protected function connectDB(): DB
    {
        echo "Подключение к mySQL - создание объекта класса MySQL <br>";
        return new MySQL();

    }

    protected function getRecord(): Record
    {
        return new MySQLRecord();
    }

    protected function getBuilder(): Builder
    {
        return new MySQLBuilder();
    }


}