<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access, Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../config/Database.php");
include_once("../../models/User.php");

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user_id = $data->user_id;
$post_id = $data->post_id;
$body = $data->body;

if($user->commentOnPost($user_id, $post_id, $body)){
  echo json_encode(array("Message" => "Comment added successfully"));
  header("Comment posted successful", FALSE, 202);
}else {
  echo json_encode(array("Message" => "Unable to register."));
  header("Unable to complete action.", FALSE, 400);
}
