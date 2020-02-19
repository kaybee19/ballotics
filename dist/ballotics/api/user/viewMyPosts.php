<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
//header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access, Control-Allow-Methods, Authorization, X-Requested-With);

include_once("../../config/Database.php");
include_once("../../models/User.php");

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

//$email = $data->email;

$result = $user->viewMyPosts($data->email);

$num = $result->rowCount();

if($num > 0){
  $post_arr = array();
  $post_arr['data'] = array();
  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $post_data = array(
      'started' =>  $started,
      'completed' => $completed,
      'commissioned' => $commissioned,
      'location' => $location,
      'posted' => $posted,
      'description' => $description,
    );
    array_push($post_arr['data'], $post_data);
  }
  echo json_encode($post_arr['data']);
  header("Posts fetched.", FALSE, 200);
}else{
  echo json_encode(array("Message" => "No posts found."));
  header("No Posts found", FALSE, 415);
}
