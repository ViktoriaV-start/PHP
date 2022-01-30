<?php

spl_autoload_register(function ($classname) {
    require_once ($classname.'.php');
});

$message = new Sms(new Facebook(new Social(new Finish())));
$message->operation();

$message1 = new Facebook(new Social(new Finish()));
$message1->operation();

$message2 = new Social(new Sms(new Finish()));
$message2->operation();