<?php
require_once('include/clients.inc.php');
require_once('include/messanger.inc.php');

$name = $_REQUEST['name'];
$password = $_REQUEST['password'];
$to_id = $_REQUEST['to_id'];
$message = $_REQUEST['message'];
if(!isset($name) || !isset($password) || !isset($to_id) || !isset($message)){
    print(json_encode(array('ERROR'=>'Name and password and to_id and message must be set.')));
    exit(1);
}

$clients = new Clients();
$res = $clients->login($name, $password);
if(isset($res['SUCCESS'])){
    $id = $res['SUCCESS'];
    $messanger = new Messanger();
    $res = $messanger->sendMessage($id, $to_id, $message);
}
print(json_encode($res));
?>