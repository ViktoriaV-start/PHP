<?php

namespace app\model;


class Digital extends Piece
{
    public function __construct($name = null,
                                $quantity = null,
                                $measure = 'piece')
    {
        $this->name = $name;
        $this->measure = $measure;
        $this->quantity = $quantity;
    }

    public function getDigitPrice($piecePrice){
        $this->price = $piecePrice / 2;
        return $this->price;
    }
}