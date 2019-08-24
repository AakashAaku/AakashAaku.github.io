<?php
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        // get database connection
        include_once '../config/Database.php';

        // instantiate luggage status object
        include_once '../luggage_objects/LuggageStatus.php';

        $database = new Database();
        $db = $database->getConnection();
 
        $luggage_status = new LuggageStatus($db);

        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->status)) {
            
                // set luggage property values
    
                $luggage_status->luggage_status_name = $data->status;
    
 
                  // create the luggage status
                 if($luggage_status->create()){
 
                    //  response code - 201 created
                           http_response_code(201);
 
                   
                         echo json_encode(array("message" => "luggage status was created."));
                }
 
                 // if unable to create the luggage, alert
                else{
 
                  // set response code - 503 service unavailable
                  http_response_code(503);
 
                  
                  echo json_encode(array("message" => "Unable to create luggage status."));
                 }
        }
        
        else{
                  //  data is incomplete
                  // set response code - 400 bad request
                  http_response_code(400);
     
                  
                 echo json_encode(array("message" => "Unable to create luggage status. Data is incomplete."));
          }

  
?>