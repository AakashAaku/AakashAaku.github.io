<?php
 
         class Database{
             //specify 
              private $host="localhost";
              private $db_name="luggage_store_db";
              private $username="root";
              private $password="";
              public $conn;

             //get the database connection
             public function getConnection(){
                  $this->conn=null;
                try{
                      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                      $this->conn->exec("set names uft8");
                 }catch(PDOException $ex){
                      echo "Connection error: " . $ex->getMessage();
                 }
              return $this->conn;
             }
        }

?>