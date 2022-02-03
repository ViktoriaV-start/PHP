<?php

class Edit
{
    protected string $text;
    protected string $initialText;
    protected array $change;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function cut(int $startPosition, int $endPosition)
    {
        $this->initialText = $this->text;

        $cutted = mb_substr($this->text, $startPosition, $endPosition-$startPosition);
        $this->change[] = $cutted;

        $this->text = mb_substr($this->text, 0, $startPosition) . mb_substr($this->text, $endPosition);

        return $this->text;
    }

    public function paste(int $startPosition, int $endPosition, string $textPaste)
    {
        $this->change[] = $textPaste;
        $this->initialText = $this->text;
        $this->text = mb_substr($this->text, 0, $startPosition) . $textPaste . mb_substr($this->text, $endPosition);
        return $this->text;
    }

    public function unCut(int $step, string $startPosition)
    {
        $this->text = mb_substr($this->text, 0, $startPosition) . $this->change[$step] . mb_substr($this->text, $startPosition);
        return $this->text;
    }

    public function unPaste(int $step, string $startPosition)
    {
        $length = mb_strlen($this->change[$step]);
        $this->text = mb_substr($this->text, $length);
        return $this->text;
    }

    public function copy(int $startPosition, int $endPosition) {
        $coppied = mb_substr($this->text, $startPosition, $endPosition-$startPosition);
        $this->change[] = $coppied;
        return $coppied;
    }

    public function unCopy(int $step) {
        return $this->change[$step];
    }
}