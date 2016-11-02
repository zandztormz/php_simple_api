<?php
include 'Task.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);


$api = new Task();
if($method == 'GET' && $request[0] == '' && $request[1] == '') {
    $response =  $api->index();
}elseif($method == 'GET' && preg_match('/^[0-9]*$/', $request[0]) && $request[1] == '') {
    $response = $api->detail($request[0]);
}elseif ($method == 'POST') {
    $response =  $api->save($input);
}elseif ($method == 'PUT' && $request[0] != '' && $request[1] == '') {
    $response =  $api->update($input, $request[0]);
}elseif ($method == 'PUT' && $request[0] != '' && $request[1] == 'status') {
    $response =  $api->status($request[0]);
}elseif ($method == 'DELETE' && $request[0] != '') {
    $response =  $api->delete($request[0]);
}else{
    $response['status_code'] = 405;
    $response['status'] = 'Method Not Allowed';
}

http_response_code($response['status_code']);
echo json_encode($response);