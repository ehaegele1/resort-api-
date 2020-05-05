<?php
include_once __DIR__ . '/../models/resort.php';

header('Content-Type: application/json');


if ($_REQUEST['action'] === 'index') {
  echo json_encode(Resorts::all());
}

elseif ($_REQUEST['action'] === 'post') {
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $new_resort = new Resort(null, $body_object->location, $body_object->mountain);
  $all_resorts = Resorts::create($new_resorts);
  echo json_encode($all_resorts);
}

else if ($_REQUEST['action'] === 'update') {
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $updated_resort = new Resort($_REQUEST['id'], $body_object->location, $body_object->mountain);
  $all_resorts = Resort::update($updated_resort);
  echo json_encode($all_resorts);
}

else if ($_REQUEST['action'] === 'delete') {
  $all_resorts = Resorts::delete($_REQUEST['id']);
  echo json_encode($all_resorts;
}
?>
