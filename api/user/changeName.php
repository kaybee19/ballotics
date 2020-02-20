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
$first_name = $data->first_name;
$middle_name = $data->middle_name;
$last_name = $data->last_name;


if($user->changeName($id,$first_name, $middle_name, $last_name)){
  echo json_encode(array("Message" => "Yess!!"));
}else{
  echo json_encode(array("Message" => "Nooo!!"));
}
