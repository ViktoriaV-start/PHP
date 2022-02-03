<?php

class EditCommand
{
    public Edit $edit;
    public string $action;
    public int $startPosition;
    public int $endPosition;
    public string $textPaste;

    public function __construct(Edit $edit, string $action, int $startPosition, int $endPosition, string $textPaste = '')
    {
        $this->edit = $edit;
        $this->action = $action;
        $this->startPosition = $startPosition;
        $this->endPosition = $endPosition;
        $this->textPaste = $textPaste;
    }

    public function execute() {

        switch ($this->action) {
            case 'cut' :
                echo "<br>CUT:<br>";

                return $this->edit->cut($this->startPosition, $this->endPosition);
                break;

            case 'paste' :
                echo "<br>PASTE:<br>";
                return $this->edit->paste($this->startPosition, $this->endPosition, $this->textPaste);
                break;

            case 'copy' :
                echo "<br>COPY:<br>";
                return $this->edit->copy($this->startPosition, $this->endPosition);
                break;
        }
    }

    public function unExecute($step) {

        switch ($this->action) {
            case 'cut' :
                return $this->edit->unCut($step, $this->startPosition);
                break;

            case 'paste' :
                return $this->edit->unPaste($step, $this->startPosition);
                break;

            case 'copy' :
                return $this->edit->unCopy($step);
                break;
        }
    }
}