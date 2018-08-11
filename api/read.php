<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/config.php';
include_once '../controller/controller.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate object
$controller = new Controller($db);

//  read query
$result = $controller->read();
// Get row count
$num = $result->rowCount();

// Check if any contraller
if ($num > 0) {
    // controller array
    $controller_arr = array();
    // $controller_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $controller_item = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'age' => $age,
            'created_at' => $created_at,
        );

        // Push to "data"
        array_push($controller_arr, $controller_item);
    }

    // Turn to JSON & output
    echo json_encode($controller_arr);

} else {
    // No Categories
    echo json_encode(
        array('message' => 'No Categories Found')
    );
}
