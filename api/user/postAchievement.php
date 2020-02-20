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

$email = $data->email;
$date_commenced = $data->date_commenced;
$date_completed = $data->date_completed;
$location = $data->location;
$date_commissioned = $data->date_commissioned;

print_r($data);
$user->postAchievement($email, $date_commenced, $date_completed, $location, $date_commissioned);
//$user->postAchievement("a@b.c", "2020-10-20", "2020-10-20", "KAD", "2020-10-20");
//$user->postAchievement($email, $date_commenced, $date_completed, $location, $date_commissioned);
//if($user->postAchievement($email, $date_commenced, $date_completed, $location, $date_commissioned)){
 // echo json_encode(array("Message" => "Post created successfully"));
  //header("Registration successful", FALSE, 200);
//}else{
//  echo json_encode(array("Message" => "Unable to register."));
//  header("Unable to post", FALSE, 400);
//}


