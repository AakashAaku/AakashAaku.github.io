<?php

        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        // include database and object files
        include_once '../config/Database.php';
        include_once '../luggage_objects/LuggageStatus.php';


        // instantiate database and  object
            $database = new Database();
            $db = $database->getConnection();


        // initialize object
        $luggage_status = new LuggageStatus($db);

        

        // query 
        $stmt = $luggage_status->read();
        $num = $stmt->rowCount();


        // check if more than 0 record found
        if($num>0){
 
              // luggage status array
              $luggage_status_arr=array();
              $luggage_status_arr["records"]=array();
 
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                 // extract row
                // this will make $row['name'] to
                // just $name only
                  extract($row);
 
                  $luggage_status_item=array(
                             "luggage_status_id" => $StatusId,
                             "luggage_status_name" => $StatusName
         
                    );
 
                  array_push($luggage_status_arr["records"], $luggage_status_item);
             }
 
                 // set response code - 200 OK
                  http_response_code(200);
 
                  // show luggage status data in json format
                  echo json_encode($luggage_status_arr);
            }
            else{
                 // no luggage status found will be here
                 // set response code - 404 Not found
                 http_response_code(404);
 
                 
                  echo json_encode(
                       array("message" => "No luggage status  found.")
                    );
                }

?>