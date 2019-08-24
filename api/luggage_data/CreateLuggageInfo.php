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
        include_once '../luggage_objects/LuggageInfo.php';

        $database = new Database();
        $db = $database->getConnection();
 
        $luggage_info = new LuggageInfo($db);

        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        // make sure data is not empty
        if(!empty($data->info)) {
            
                // set luggage info property values
    
                $luggage_info->luggage_info_name = $data->info;
    
 
                  // create the luggage info
                 if($luggage_info->create()){
 
                    //  response code - 201 created
                           http_response_code(201);
 
                   
                         echo json_encode(array("message" => "luggage info was created."));
                }
 
                 // if unable to create the luggage info , alert
                else{
 
                  // set response code - 503 service unavailable
                  http_response_code(503);
 
                  
                  echo json_encode(array("message" => "Unable to create luggage info."));
                 }
        }
        
        else{
                  //  data is incomplete
                  // set response code - 400 bad request
                  http_response_code(400);
     
                  
                 echo json_encode(array("message" => "Unable to create luggage info. Data is incomplete."));
          }

  
?>