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


$email = isset($_GET['email']) ? $_GET['email'] : die();
$date_commenced = isset($_GET['date_commenced']) ? $_GET['date_commenced'] : die();
$date_completed = isset($_GET['date_completed']) ? $_GET['date_completed'] : die();
$location = isset($_GET['location']) ? $_GET['location'] : die();
$date_commissioned = isset($_GET['date_commissioned']) ? $_GET['date_commissioned'] : die();

if($user->postAchievement($email, $date_commenced, $date_completed, $location, $date_commissioned)){

}else{

}
