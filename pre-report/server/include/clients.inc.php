<?php
require_once('db.inc.php');

class Clients extends Db {
    function addClient($name, $password){
        $sql = "insert into clients(name, password) values (?, MD5(?))";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($name, $password));
            /*if($stmt->rowCount() < 1){
                $errifo = $this->db->errorInfo();
                print_r($errifo);
                return array("ERROR" => $name.' WITH '.$password.' ALREADY EXISTS');
            }
            else{
                */return array("SUCCESS" => "Added ".$name." to clients");
            //}
        } 
        catch (PDOException $e) {
            return array("ERROR" => $e->getMessage());
        } 
        
    }
    function getClientWithName($name){
        $sql = 'select id, name from clients where name = ?';
        try{
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($name));
            if($stmt->rowCount() == 0){
                return array("ERROR" => "NO CLIENT NAME: ".$name);
            }
            $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
            return array("SUCCESS" => $row1);
        }
        catch (PDOException $e) {
            return array("ERROR" => $e->getMessage());
        } 
    }
    function getClientIdWithName($name){
        $res = $this->getClientWithName($name);
        if(isset($res['SUCCESS'])){
            return array('SUCCESS' => $res['SUCCESS']['id']);
        }
        return $res;
    }
    function getClientWithId($id){
        $sql = 'select id, name from clients where id = ?';
        try{
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
            if($stmt->rowCount() == 0){
                return array("ERROR" => "NO CLIENT ID: ".$id);
            }
            $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
            return array("SUCCESS" => $row1);
        }
        catch (PDOException $e) {
            return array("ERROR" => $e->getMessage());
        } 
    }
    function getClientNameWithId($id){
        $res = $this->getClientWithId($id);
        if(isset($res['SUCCESS'])){
            return array('SUCCESS' => $res['SUCCESS']['name']);
        }
        return $res;
    }
    function getClients(){
        $sql = 'select id, name from clients';
        try{
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() == 0){
                return array("ERROR" => "NO CLIENTS!");
            }
            $rtn = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($rtn, $row);
            }
            return array("SUCCESS" => $rtn);
        }
        catch (PDOException $e) {
            return array("ERROR" => $e->getMessage());
        } 
    }
    function removeClient($id){
        $sql = "delete from clients where id = ?;";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
            return array("SUCCESS" => "Removed ".$name." to clients");
        } 
        catch (PDOException $e) {
            return array("ERROR" => $e->getMessage());
        } 
        
    }
    function login($name, $password){
        $sql = "select * from clients where name = ? and password = ?;";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($name, $password));
            if($stmt->rowCount() == 1){
                $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                return array("SUCCESS" => $row1['id']);
            }
            else if($stmt->rowCount() == 0){
                return array("ERROR" => $name." with password does not exist!");
            }
            else{
                return array("ERROR" => "MORE THEN ONE client NAMED '".$name."' WITH password '".$password."'");   
            }
        } 
        catch (PDOException $e) {
            return array("ERROR" => $e->getMessage());
        } 
    }
}
?>