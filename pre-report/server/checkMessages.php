<?php
require_once('include/clients.inc.php');
require_once('include/messanger.inc.php');

$name = $_REQUEST['name'];
$password = $_REQUEST['password'];
if(!isset($name) || !isset($password)){
    print(json_encode(array('ERROR'=>'Name and password must be set.')));
    exit(1);
}

$clients = new Clients();
$res = $clients->login($name, $password);
if(isset($res['SUCCESS'])){
    $id = $res['SUCCESS'];
    $messanger = new Messanger();
    $res = $messanger->checkMessagesForId($id);
}
print(json_encode($res));
?>