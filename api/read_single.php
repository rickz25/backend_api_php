<?php 
  // Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/config.php';
include_once '../controller/controller.php';

  // Instantiate DB & connect
$database = new Database();
$db = $database->connect();

  // Instantiate blog post object
$controller = new Controller($db);

  // Get ID
$controller->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
$controller->read_single();

  // Create array
$controller_arr = array(
    'id' => $controller->id,
    'name' => $controller->name,
    'email' => $controller->email,
    'age' => $controller->age,
    'created_at' => $controller->created_at
);

  // Make JSON
print_r(json_encode($controller_arr));