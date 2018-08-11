<?php 
  // Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../database/config.php';
include_once '../../controller/controller.php';

  // Instantiate DB & connect
$database = new Database();
$db = $database->connect();

  // Instantiate blog post object
$controller = new Controller($db);

  // Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$controller->name = $data->name;
$controller->email = $data->email;
$controller->age = $data->age;

  // Create post
if ($controller->create()) {
    echo json_encode(
        array('message' => 'Post Created')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}


