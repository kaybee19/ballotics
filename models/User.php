<?php
    class User{
        
        private $user_email;
        
        public function __constructor(){
            //
        }

        public function login($email, $password){
            //   
            $stmt = "SELECT User.email FROM User WHERE User.email = ?? AND User.password = ?? LIMIT 1";
            $this->email = $email;
        }
        
        public function register($email, $password){
            //
            $stmt = "INSERT INTO `User`() VALUE() ";
        }
        
        public function sendMessage($message_body, $recipient_id){
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
            
        }
        
        public function changePassword(){
            
        }
        
        public function changeLocation(){
            
        }
        
        public function follow($user_email){
            
        }
        
        public function changeProfilePicture(){
            
        }
        
        public function edit_profile(){
            //
            $stmt = "INSERT INTO User";
        }
    }
