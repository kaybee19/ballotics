<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once("../../config/Database.php");
    include_once("../../models/User.php");

    $database = new Database();
    $db = $databae->connect();

    $user = new User($db);

    $result = $user->login();

    $num = $result->rowCount();

    if($num > 0){
        $user_arr = array();
        $user_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            etract($row);

            $user_data = array(
                'email' = $email; 
            );
            array_push($user_arr['data'], $user_data);

            echo json_encode($user_arr);
        }
    }else{
        echo json_ecode("message" => "Incorrect login credentials")
    }

