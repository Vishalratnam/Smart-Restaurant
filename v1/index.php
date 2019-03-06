<?php
 
require_once '../include/DbHandler.php';
require '.././libs/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
 
$app = new \Slim\Slim();
 
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
 
    // setting response content type to json
    $app->contentType('application/json');
 
    echo json_encode($response);
}
$app->get('/tasks',function() {
            $response = array();
            $db = new DbHandler();
 
            // fetching all user tasks

            $result = $db->getAllUserTasks();
			//echo $result;
            $response["products"] = array();
 
            // looping through result and preparing tasks array
            while ($task = $result->fetch_assoc()) {
                $tmp = array();
                $tmp["id"] = $task["id"];
                $tmp["name"] = $task["name"];
                $tmp["price"] = $task["price"];
                array_push($response["products"], $tmp);
            }
			$response["success"] = 1;
            $app = \Slim\Slim::getInstance();
			// Http response code
			$app->status(200);
 
			// setting response content type to json
			$app->contentType('application/json');
 
			echo json_encode($response);
        });
$app->run();
	
?>