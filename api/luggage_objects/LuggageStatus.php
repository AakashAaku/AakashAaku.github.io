<?php 

   class LuggageStatus{

       // database connection and table name
        private $conn;
        private $table_name = "luggage_status";

         // object properties
        public $luggage_status_id;
        public $luggage_status_name;

        // constructor with $db as database connection
         public function __construct($db){
         $this->conn = $db;
        }


         // read luggage status
        function read(){
 
         // select all query
         $query = "SELECT
                ls.luggage_status_id as StatusId,ls.luggage_status_name as StatusName
                  FROM
                " . $this->table_name . " ls ";
 
          // prepare query statement
         $stmt = $this->conn->prepare($query);
 
         // execute query
         $stmt->execute();
 
         return $stmt;
        }


        // create luggage status
        function create(){
 
               // query to insert record
               $query = "INSERT INTO
                " . $this->table_name . "
                   SET
                     luggage_status_name=:status";
 
              // prepare query
               $stmt = $this->conn->prepare($query);
 
             // sanitize
             $this->luggage_status_name=htmlspecialchars(strip_tags($this->luggage_status_name));
 
             // bind values
              $stmt->bindParam(":status", $this->luggage_status_name);
   
 
              // execute query
              if($stmt->execute()){
                  return true;
              }
 
                return false;
     
          }

   }

   
?>