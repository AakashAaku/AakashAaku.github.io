<?php

        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        // include database and object files
        include_once '../config/Database.php';
        include_once '../luggage_objects/RegUserLuggage.php';


        // instantiate database and  object
            $database = new Database();
            $db = $database->getConnection();


        // initialize object
        $reg_user_luggage = new RegUserLuggage($db);

        

        // query 
        $stmt = $reg_user_luggage->read();
        $num = $stmt->rowCount();


        // check if more than 0 record found
        if($num>0){
 
              // luggage user info array
              $reg_user_luggage_arr=array();
              $reg_user_luggage_arr["records"]=array();
 
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                 // extract row
                // this will make $row['name'] to
                // just $name only
                  extract($row);
 
                  $reg_user_luggage_item=array(
                             "reg_user_luggage_id" => $UserLuggageId,
                             "reg_user_id" => $UserId,
                             "luggage_check_in" => $CheckIn,
                             "luggage_check_out" => $CheckOut,
                             "luggage_status" => $lStatus,
                             "luggage_image" => $LuggageImage
         
                    );
 
                  array_push($reg_user_luggage_arr["records"], $reg_user_luggage_item);
             }
 
                 // set response code - 200 OK
                  http_response_code(200);
 
                  // show luggage user data in json format
                  echo json_encode($reg_user_luggage_arr);
            }
            else{
                 // no luggage user found will be here
                 // set response code - 404 Not found
                 http_response_code(404);
 
                 
                  echo json_encode(
                       array("message" => "No luggage user  found.")
                    );
                }

?>