<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once "../../includes/dbconfig.php";
// include_once "../../class/auth.php";

// $test = $content->Test();
// print_r($test);
// exit;

 
// set ID property of record to read
$content->id = isset($_GET['id']) ? $_GET['id'] : die();
// print_r($content->id);
// exit;
// read the details of product to be edited
$readOne = $content->ReadOne();

// print_r($readOne);
// $num = $readOne->rowCount();
// print_r($num);
// exit;


if($content->id != null ){
    // print_r($readOne);
    
    // create array
    $content_arr = array(
        "id" =>  $content->id,
        "title" => $content->title,
        "summery" => $content->summery,
        "description" => $content->description,
        "category_id" => $content->category_id,
        "category_name" => $content->category_name,
        "created" => $content->created,
        "post_u_id" => $content->post_u_id
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($content_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>