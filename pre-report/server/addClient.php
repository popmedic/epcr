<?php
require_once('include/clients.inc.php');

$name = $_REQUEST['name'];
$password = $_REQUEST['password'];
if(!isset($name) || !isset($password)){
    print(json_encode(array('ERROR'=>'Name and password must be set.')));
    exit(1);
}

$clients = new Clients();
$res = $clients->addClient($name, $password);
print(json_encode($res));
?>