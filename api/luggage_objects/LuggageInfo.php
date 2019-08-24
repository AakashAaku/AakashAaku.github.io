<?php 

   class LuggageInfo{

       // database connection and table name
        private $conn;
        private $table_name = "luggage_info";

         // object properties
        public $luggage_info_id;
        public $luggage_info_name;

        // constructor with $db as database connection
         public function __construct($db){
         $this->conn = $db;
        }


         // read luggage info
        function read(){
 
         // select all query
         $query = "SELECT
                li.luggage_info_id as InfoId,li.luggage_info_name as InfoName
                  FROM
                " . $this->table_name . " li ";
 
          // prepare query statement
         $stmt = $this->conn->prepare($query);
 
         // execute query
         $stmt->execute();
 
         return $stmt;
        }


        // create luggage info
        function create(){
 
               // query to insert record
               $query = "INSERT INTO
                " . $this->table_name . "
                   SET
                     luggage_info_name=:info";
 
              // prepare query
               $stmt = $this->conn->prepare($query);
 
             // sanitize
             $this->luggage_info_name=htmlspecialchars(strip_tags($this->luggage_info_name));
 
             // bind values
              $stmt->bindParam(":info", $this->luggage_info_name);
   
 
              // execute query
              if($stmt->execute()){
                  return true;
              }
 
                return false;
     
          }

   }

   
?>