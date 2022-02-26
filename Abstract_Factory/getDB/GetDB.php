<?php

abstract class GetDB
{
    private DB $db;
    private Record $record;
    private Builder $builder;


    public function __construct()
    {
        $this->db = $this->connectDB();
        $this->record = $this->getRecord();
        $this->builder = $this->getBuilder();
    }

    public function start()
    {
        echo "Функция start в абстрактном классе GetDB запускает функции объектов \$db:<br>";
        $this->db->working();
        $this->record->recordToDB();
        $this->builder->buildQuote();
    }

    abstract protected function connectDB(): DB;
    abstract protected function getRecord(): Record;
    abstract protected function getBuilder(): Builder;

}