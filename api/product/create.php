<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../includes/dbconfig.php";
// include_once "../../class/auth.php";

// $test = $content->CreateContent();
// print_r($test);
// exit;

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if($data
    // !empty($data->title) && 
    // !empty($data->summery) &&
    // !empty($data->description) && 
    // !empty($data->category_id)&&
    // !empty($data->post_u_id)
)
{
    
    // set content property values
    $content->title = $data->title;
    $content->summery = $data->summery;
    $content->description = $data->description;
    $content->category_id = $data->category_id;
    $content->post_u_id = $data->post_u_id;

    
    // create the content
    if($content->CreateContent()){
        
        // print_r($content->CreateContent());
        // exit;
        
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }

    // if unable to create the product, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>