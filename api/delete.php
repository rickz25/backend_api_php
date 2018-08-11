<?php 
  // Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../database/config.php';
include_once '../controller/controller.php';

  // Instantiate DB & connect
$database = new Database();
$db = $database->connect();

  // Instantiate blog post object
$controller = new Controller($db);

  // Get raw posted data
$data = json_decode(file_get_contents("php://input"));

  // Set ID to update
$controller->id = $data->id;

  // Delete post
if ($controller->delete()) {
    echo json_encode(
        array('message' => 'User Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'User Not Deleted')
    );
}

