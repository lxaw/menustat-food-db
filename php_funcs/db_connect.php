<?php

// connect to mysql mysqli object
//

// get configs
//
include_once('db_config.php');

// Class to create connection to 
// mysql server
//

class MySQLiConnection{
    // connection to mysql
    //
    public $conn = NULL;

    function __construct(){
        // open connection when constructed
        //
        $this->OpenConn();
    }
    function __destruct(){
        // close connection when destroyed
        //
        $this->CloseConn();
    }

    private function OpenConn(){
        // open connection
        //
        try{
            $this->conn = new mysqli(kDB_HOST,kDB_USER,kDB_PASSWORD,kDB_NAME
            ) or 
            die("connection failed: %s\n".$conn->error);
        }catch(Exception $e){
            echo($e);
            return NULL;
        }
    }

    private function CloseConn(){
        // close connection
        //
        if($this->conn != NULL){
            $this->conn->close();
        }
    }
    // get the sql connection by reference
    //
    public function &mysqli(){
        return $this->conn;
    }

    public function execute($strQuery){
        // executes a query
        // NOTE: THIS IS UNSAFE!
        // ALWAYS USE PREPARED QUERIES
        //
        if($this->conn == NULL){
            die('ERROR: no connection to mysql.');
            return;
        }
        try{
            $res = mysqli_query($this->conn,$strQuery);
            return mysqli_fetch_all($res,MYSQLI_ASSOC);
        }catch(Exception $e){
            echo($e);
            return NULL;
        }

    }
}