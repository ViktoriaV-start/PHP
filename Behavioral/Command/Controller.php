<?php

class Controller
{
    private Edit $edit;
    private array $commands;
    private int $currentCounter;

    public function __construct($text)
    {
        $this->edit = new Edit($text);
        $this->currentCounter = 0;
    }

    public function action(string $action,
                           int $startPosition,
                           int $endPosition,
                           string $textPaste =  '') {

        $command = new EditCommand($this->edit,
                                   $action,
                                   $startPosition,
                                   $endPosition,
                                   $textPaste);

        $result = $command->execute();
        $this->commands[] = $command;
        $this->currentCounter++;

        return $result;
    }

    public function rollBack(int $steps) {

        if (count($this->commands) >= $steps) {
            echo "<br><br>ОТМЕНА ОПЕРАЦИЙ: $steps";

            for ($i = 0; $i < $steps; $i++) {
                $step = --$this->currentCounter;

                echo "<br><br>";

                echo $this->commands[$step]->unExecute($step);
            }
        } else {
            echo "<br><br>Для отмены уточните количество операций";
        }
    }

    public function repeat(int $steps) {

        if (($this->currentCounter + $steps) <= count($this->commands)) {

            echo "<br><br>ВОЗВРАТ ОПЕРАЦИЙ: $steps";

            for ($i = 0; $i < $steps; $i++) {
                $step = $this->currentCounter;

                echo "<br><br>";

                echo $this->commands[$step]->execute();
                $this->currentCounter++;
            }
        } else {
            echo "<br><br>Уточните количество операций";
        }
    }
}