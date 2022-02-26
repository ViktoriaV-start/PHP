<?php

class CircleAreaLib
{

    public function getCircleArea(int $diagonal)
    {
        $area = (M_PI * ($diagonal**2))/4;

       return $area;
   }

}