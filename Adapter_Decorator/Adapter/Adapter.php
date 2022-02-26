<?php

class Adapter implements ISquare, ICircle
{
    protected $lib = null;

    public function squareArea(int $sideSquare)
    {
        $this->lib = new SquareAreaLib();
        $diagonal = round(1.41*$sideSquare);
        echo "<br><br>Сторона квадрата равна " . $sideSquare;
        echo "<br>Диагональ равна " . $diagonal;
        echo "<br>Площадь квадрата равна ";
        echo $this->lib->getSquareArea($diagonal);
    }

    public function circleArea(int $circumference) {
        $this->lib = new CircleAreaLib();
        $diagonal = round($circumference/M_PI);
        echo "<br><br>Длина окружности равна " . $circumference;
        echo "<br>Диаметр равен " . $diagonal;
        echo "<br>Площадь круга равна ";
        echo round($this->lib->getCircleArea($diagonal), 2);
    }
}