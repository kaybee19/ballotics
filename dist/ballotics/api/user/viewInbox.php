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

    $result = $user->viewInbox($email);

    $num = $result->rowCount();

    if($num > 0){
      $message_arr = array();
      $message_arr['data'] = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $message_data = array(
          'sender' => $sender,
          'body' => $body,
          'id' => $id,
          'time_sent' => $time_sent
        );
        array_push($message_arr['data'], $message_data);
      }
      echo json_encode($message_arr['data']);
      header("User logged in", FALSE, 200);
    }else{
      echo json_encode(array("Message" => "No messages"));
      header("No messages", FALSE, 415);
    }
