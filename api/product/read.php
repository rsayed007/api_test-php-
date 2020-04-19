<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once "../../includes/dbconfig.php";
// include_once "../../class/auth.php";

$test = $content->Test();
// print_r($test);
// exit;
$read_content = $content->ReadAllData();
// print_r($read_content);
$num = $read_content->rowCount();
if ($num >0) {
    $content_arr = array();
    $content_arr['records']=array();

    while ($row =  $read_content->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // print_r($row);

        $content_item=array(
            "id" => $id,
            "title" => $post_title,
            "summery" => $post_summary,
            "description" => html_entity_decode($post_details),
            "category_id" => $category_id,
            "category_name" => $z_category_name,
            "created" => $created_at
        );
        array_push($content_arr['records'], $content_item);
    }
    http_response_code(200);

    echo json_encode($content_arr);
}

