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
    $password = $data->password;

    if($user->register($email, $password)){
      echo json_encode(array("Message" => "Registered successfully."));
      header("Registration successful", FALSE, 202);
    }else {
      echo json_encode(array("Message" => "Unable to register."));
      header("Unable to register", FALSE, 400);
    }

    //$email = isset($_GET['email']) ? $_GET['email'] : die();
    //$password = isset($_GET['password']) ? $_GET['password'] : die();



    /*if($user->register($email, $password)){
      echo json_encode(array("Message" => "Registered successfully."));
      header("Registration successful", FALSE, 202);
    }else{
      echo json_encode(array("Message" => "Unable to register."));
      header("Unable to register", FALSE, 400);
    }*/
