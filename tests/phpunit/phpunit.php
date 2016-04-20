<?php


require __DIR__.'/Autoload.php';

$Autoload = new \Rundiz\Thaidate\Tests\Autoload();
$Autoload->addNamespace('Rundiz\\Thaidate\\Tests', __DIR__);
$Autoload->addNamespace('Rundiz\\Thaidate', dirname(dirname(__DIR__)).'/Rundiz/Thaidate');
$Autoload->register();

require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/thaidate-functions.php';