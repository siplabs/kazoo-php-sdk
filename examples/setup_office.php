<?php

require_once "../vendor/autoload.php";
use \Kazoo\AuthToken\User;
use \Kazoo\SDK;
require('HostileWorkEnvironment.php'); 

$creation = new HostileWorkEnvironment;

for ($i = 1001; $i <= 1010; $i++){
    $creation->createDevice($i); 
}

