<?php

        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        // include database and object files
        include_once '../config/Database.php';
        include_once '../luggage_objects/LuggageInfo.php';


        // instantiate database and  object
            $database = new Database();
            $db = $database->getConnection();


        // initialize object
        $luggage_info = new LuggageInfo($db);

        

        // query 
        $stmt = $luggage_info->read();
        $num = $stmt->rowCount();


        // check if more than 0 record found
        if($num>0){
 
              // luggage info array
              $luggage_info_arr=array();
              $luggage_info_arr["records"]=array();
 
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                 // extract row
                // this will make $row['name'] to
                // just $name only
                  extract($row);
 
                  $luggage_info_item=array(
                             "luggage_info_id" => $InfoId,
                             "luggage_info_name" => $InfoName
         
                    );
 
                  array_push($luggage_info_arr["records"], $luggage_info_item);
             }
 
                 // set response code - 200 OK
                  http_response_code(200);
 
                  // show luggage info data in json format
                  echo json_encode($luggage_info_arr);
            }
            else{
                 // no luggage info found will be here
                 // set response code - 404 Not found
                 http_response_code(404);
 
                 
                  echo json_encode(
                       array("message" => "No luggage info  found.")
                    );
                }

?>