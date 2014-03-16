<?php
require_once('include/clients.inc.php');
require_once('include/messanger.inc.php');

$name = $_REQUEST['name'];
$password = $_REQUEST['password'];
$id = $_REQUEST['id'];
if(!isset($name) || !isset($password) || !isset($id)){
    print(json_encode(array('ERROR'=>'Name and password and id must be set.')));
    exit(1);
}

$clients = new Clients();
$res = $clients->login($name, $password);
if(isset($res['SUCCESS'])){
    $res = $messanger->getClientNameWithId($id);
}
print(json_encode($res));
?>