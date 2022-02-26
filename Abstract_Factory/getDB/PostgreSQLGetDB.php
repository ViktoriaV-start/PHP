<?php

class PostgreSQLGetDB extends GetDB
{
    protected function connectDB(): DB
    {
        echo "Подключение к PostgreSQL - создание объекта класса PostgreSQL <br>";
        return new PostgreSQL();
    }

    protected function getRecord(): Record
    {
        return new PostgreSQLRecord();
    }

    protected function getBuilder(): Builder
    {
        return new PostgreSQLBuilder();
    }

}