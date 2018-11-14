<?php

include('core/init.php');

$user = new User;
$toast = Toast::get();
$msg = new Message;
$user->login_check();
$user->check_token(Config::get('csrf_token'));


?>
