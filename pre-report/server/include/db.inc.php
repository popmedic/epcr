<?php
require_once('config.inc.php');

class Db{
    protected $db;
    function __construct(){
        global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS;
        try {
            $this->db = new PDO($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS);
        } 
        catch (PDOException $e) {
            print json_encode(array("ERROR" => $e->getMessage()));
            die();
        }   
    }
    function __destroy(){
        $this->db->close();
    }
    function getCurrentTimestamp(){
        try{
            $sql = 'select CURRENT_TIMESTAMP;';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_NUM);
            return $row[0];
        }
        catch (PDOException $e) {
            return(array("ERROR" => $e->getMessage()));
        }  
    }
}
?>