<?php

namespace app\controllers;

class Controller
{
  public function render($twig, $navigation, $goods) {
    echo $twig->render('index.twig', [ // синтаксис для рендера страницы
      'navigation' => $navigation,
      'goods' => $goods
        // это передача параметров/переменных, которые используем в шаблоне, который
        // находится в index.twig. То есть в коде выше рендера есть переменные -$navigation, $images,
        // а здесь их передаем внутрь index.twig.
        //Внимание! если внутри шаблона подключается еще шаблон (навигация, футер),
        //здесь также нужно передать параметры и для них, иначе не сработает.
    ]);
  }
}