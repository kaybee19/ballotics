<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Database{
     //  DB Params
        private $host = 'localhost';
        private $db_name = 'ballotic_db';
        private $username = 'ballotic_admin';
        private $password = '2wo1ne8ight';
        private $conn;
         //  DB Connect
        public function connect(){
            $this->conn = null;            
            try{
                $this->conn = new PDO('mysql: host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Error: '.$e->getMessage();
            }
            return $this->conn;
        }
}

