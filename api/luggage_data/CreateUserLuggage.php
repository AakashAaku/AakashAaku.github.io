<?php
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        // get database connection
        include_once '../config/Database.php';

        // instantiate luggage info object
        include_once '../luggage_objects/RegUserLuggage.php';

        $database = new Database();
        $db = $database->getConnection();
 
        $reg_user_luggage = new RegUserLuggage($db);

        // get posted data
         $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
      //  console.log(echo $data);
        if(!empty($data->guestname)) {
            
                // set user luggage property values
    
                $reg_user_luggage->reg_user_id = $data->guestname;
                // $reg_user_luggage->luggage_check_in = $data->check_in;
                // $reg_user_luggage->luggage_check_out = $data->check_out;
                $reg_user_luggage->luggage_status =  $data->status;
                $reg_user_luggage->luggage_image =  $data->luggage_image;
               // $luggage_image->created = date('Y-m-d H:i:s');
 
                  // create the user luggage 
                 if($reg_user_luggage->create()){
 
                    //  response code - 201 created
                           http_response_code(201);
 
                   
                         echo json_encode(array("message" => "User luggage  was created."));
                }
                 // if unable to create the user luggage  , alert
                else{
 
                  // set response code - 503 service unavailable
                  http_response_code(503);
 
                  
                  echo json_encode(array("message" => "Unable to create user luggage."));
                 }
        }
        else{
                  //  data is incomplete
                  // set response code - 400 bad request
                  http_response_code(400);
     
                  
                 echo json_encode(array("message" => "Unable to create user luggage . Data is incomplete."));
          }

  
?>