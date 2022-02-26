<?php

class SquareAreaLib
{

    public function getSquareArea(int $diagonal)
    {
        $area = ($diagonal**2)/2;

        return $area;
    }

}