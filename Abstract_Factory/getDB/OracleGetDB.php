<?php

class OracleGetDB extends GetDB
{
    protected function connectDB(): DB
    {
        echo "Подключение к OracleGetDB - создание объекта класса OracleGetDB <br>";
        return new Oracle();
    }

    protected function getRecord(): Record
    {
        return new OracleRecord();
    }

    protected function getBuilder(): Builder
    {
        return new OracleBuilder();
    }
}

