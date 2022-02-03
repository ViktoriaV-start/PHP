<?php

spl_autoload_register(function ($class) {
    include $class . '.php';
});

$user1 = new User('Jay', 'jay@mail.com', 11);
$user2 = new User('Al', 'ally@mail.com', 3);
$user3 = new User('Dany', 'dany@mail.com', 1);

$user1->notify('programmerPHP');
$user3->notify('programmerPHP');
var_dump(ProgrammerPHP::getInstance()->observers);
$user3->unNotify('programmerPHP');
var_dump(ProgrammerPHP::getInstance()->observers);
$user2->notify('designer');
//var_dump(Designer::getInstance()->observers);

$new = new UniqueVacancy("programmerPHP", 1, 'IT-rev');
$new = new UniqueVacancy("programmerPHP", 2, 'Turbo-drive');
$new = new UniqueVacancy("programmerPHP", 3, 'Tech');
$new = new UniqueVacancy("designer", 1, 'Super Star');
$new = new UniqueVacancy("designer", 2, 'Flowers');