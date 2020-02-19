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

    $result = $user->login($email, $password);

    $num = $result->rowCount();

    if($num > 0){
      $user_arr = array();
      $user_arr['data'] = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $user_data = array(
          'id' => $id,
          'name' => $name,
          'admin' => $admin
        );
        array_push($user_arr['data'], $user_data);
      }
      echo json_encode($user_arr['data']);
      header("User logged in", FALSE, 200);
    }else {
      echo json_encode(array("Message" => "Invalid login credentials"));
      header("Invalid login credentials", FALSE, 415);
    }




