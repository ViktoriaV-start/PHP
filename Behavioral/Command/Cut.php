<?php

class Cut
{

    public function action(int $startPosition, int $endPosition, string $textPast = null)
    {
        $this->newText = mb_substr($this->text, 0, $startPosition) . mb_substr($this->text, $endPosition);
        echo $this->newText;

    }

    public function down()
    {
        echo $this->text;
    }
}