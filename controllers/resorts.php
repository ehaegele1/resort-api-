<?php
include_once __DIR__ . '/../models/resort.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

if ($_REQUEST['action'] === 'index') {
  echo json_encode(Resorts::all());
}

elseif ($_REQUEST['action'] === 'post') {
  $request_body = file_get_contents('php://input');
  echo '!!!!!!!!!!!!!!!!!!!!!!!! \n';
  echo $request_body;
  echo '!!!!!!!!!!!!!!!!!!!!!!!!\n';
  $body_object = json_decode($request_body);
  $new_joke = new Resort(null, $body_object->location, $body_object->photo);
  $all_jokes = Resorts::create($new_resorts);
  echo json_encode($all_resorts);
}

else if ($_REQUEST['action'] === 'update') {
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $updated_resort = new Resort($_REQUEST['id'], $body_object->location, $body_object->photo);
  $all_resorts = Resort::update($updated_resort);
  echo json_encode($all_resorts);
}

else if ($_REQUEST['action'] === 'delete') {
  $all_resorts = Resorts::delete($_REQUEST['id']);
  echo json_encode($all_resorts;
}
?>
