<?php
    class User{
        private $conn;
        private $db;
        private $jwt;
        private $email;

        public function __construct($db){
            $this->conn = $db;
        }

        public function login($email, $password){
            $sql = "SELECT * FROM `User` WHERE User.email = :email aND User.password = :password";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', md5($password));
            $stmt->execute();
            
            return $stmt;
            //$userDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //$user_data = json_encode($userDetails);
            //echo($user_data);
        }

        public function register($email, $password){
            //
            $stmt = "INSERT INTO `User`(User.email, User.password) VALUE(??, ??) ";
        }

        public function sendMessage($message_body, $recipient_email){
            //
            $stmt = "INSERT INTO TABLE";
        }

        public function comment($post_id, $comment_body){
            //
            $stmt = "";
        }

        public function react($post_id, $sentiment){
            //
            $stmt = "";
        }

        public function logout(){
            //
            $stmt = "";
        }

        public function changeName(){
            //
        }

        public function changePassword(){
            //
        }

        public function changeAddress(){
            //
        }

        public function follow($user_email){
            //
        }

        public function changeProfilePicture(){
            //
        }
    }
