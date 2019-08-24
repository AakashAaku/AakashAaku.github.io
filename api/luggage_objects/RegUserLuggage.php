<?php 

   class RegUserLuggage{

       // database connection and table name
        private $conn;
        private $table_name = "reg_user_luggage";

         // object properties
        public $reg_user_luggage_id;
        public $reg_user_id;
        public $luggage_check_in;
        public $luggage_check_out;
        public $luggage_status;
        public $luggage_image;

        // constructor with $db as database connection
         public function __construct($db){
         $this->conn = $db;
        }


         // read all user luggage
        function read(){
 
         // select all query
         $query = "SELECT
                rul.reg_user_luggage_id as UserLuggageId,
                rul.reg_user_id as UserId,
                rul.luggage_check_in as CheckIn,
                rul.luggage_check_out as CheckOut,
                rul.luggage_status as lStatus,
                rul.luggage_image as LuggageImage
                  FROM
                " . $this->table_name . " rul ";
 
          // prepare query statement
         $stmt = $this->conn->prepare($query);
 
         // execute query
         $stmt->execute();
 
         return $stmt;
        }


        // create luggage info
        function create(){
              try{

                  // query to insert record
               $query = "INSERT INTO
               " . $this->table_name . "
                  SET
                    reg_user_id=:luggageGuest,
                    luggage_status=:luggageStatus, 
                    luggage_image=:luggageImage";

                      // luggage_check_in=:luggageCheckIn,
                    // luggage_check_out=:luggageCheckIn,

             // prepare query
              $stmt = $this->conn->prepare($query);

            // sanitize
            $this->reg_user_id=htmlspecialchars(strip_tags($this->reg_user_id));
            // $this->luggage_check_in=htmlspecialchars(strip_tags($this->luggage_check_in));
            // $this->luggage_check_out=htmlspecialchars(strip_tags($this->luggage_check_out));
            $this->lugage_status=htmlspecialchars(strip_tags($this->luggage_status));
            $this->luggage_image=htmlspecialchars(strip_tags($this->luggage_image));

            // bind values
             $stmt->bindParam(":luggageGuest", $this->reg_user_id);
            //  $stmt->bindParam(":luggageCheckIn", $this->luggage_check_in);
            //  $stmt->bindParam(":luggageCheckIn", $this->luggage_check_out);
             $stmt->bindParam(":luggageStatus", $this->luggage_status);
             $stmt->bindParam(":luggageImage", $this->luggage_image);
  

             // execute query
             if($stmt->execute()){
                 return true;
             }else{
              return false;
             }

            }catch(Exception $e){
              echo "Error while saving : " . $e->getMessage() . "\n";
            }
              
     
      }





   }

   
?>