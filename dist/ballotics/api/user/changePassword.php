<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access, Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../config/Database.php");
include_once("../../models/User.php");

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$old_password = md5($data->old_password);
$new_password = md5($data->new_password);

if($user->changePassword($id, $old_password, $new_password)){
  echo json_encode(array("Message" => "Password changed"));
}else{
  echo json_encode(array("Message" => "Password not changed."));
}
