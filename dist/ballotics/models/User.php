<?php
    class User{
        private $conn;
        private $db;
        private $jwt;
        public $email;
        public $password;

        public function __construct($db){
            $this->conn = $db;
        }

        public function login($email, $password){
            //
            $query = "
              SELECT
                User.email as email,
                CONCAT(Name.first_name, ' ',
                Name.middle_name, ' ',
                Name.last_name) as name
                FROM User
              JOIN Name ON Name.email = User.email
              WHERE
                User.email = :email
                AND
                User.password = :password
            " ;
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', md5($password));
            $stmt->execute();
            return $stmt;
        }

        public function register($email, $password){
          //
          $query = "INSERT INTO `User`(`email`, `password`)
                        VALUES(:email, :password);
                    INSERT INTO `Name`(`email`)
                        VALUE(:email)";
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':password', md5($password));
          if($stmt->execute()){
            return true;
          }
          printf("Error: %s.\n", $stmt->error);
          return false;

        }

      public function sendMessage($sender_email, $recipient_email, $body){
        //
        $query = "INSERT INTO `Message`(`sender_email`, `recipient_email`, `body`)
                    VALUES(:sender_email, :recipient_email, :body);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sender_email', $sender_email);
        $stmt->bindParam(':recipient_email', $recipient_email);
        $stmt->bindParam(':body', $body);
        if($stmt->execute()){
          return true;
        }
        return false;
      }

      public function viewInbox($email){
        //
        $query = "SELECT
                    Message.id as id,
                    Message.body as body,
                    Message.sender_email as sender,
                    Message.time_sent as time_sent
                    FROM `Message`
                    WHERE Message.recipient_email = :email
                    ORDER BY Message.time_sent DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt;
      }

      public function readMessage($email, $message_id){
        $query = "SELECT
                    Message.id as id,
                    Message.body as body,
                    Message.sender_email as sender,
                    Message.time_sent as time_sent
                    FROM `Message`
                    WHERE Message.recipient_email = :email
                        AND Message.id = :id
                        LIMIT 1
                  ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $message_id);
        $stmt->execute();
        return $stmt;
      }

      public function postAchievement($email, $date_commenced, $date_completed, $location, $date_commissioned){
        //
        $sql = "INSERT INTO `POST`(`id`, `user_email`, `date_commenced`, `date_completed`, `location`, `date_commissioned`, `time_posted`)
                VALUES(NULL, :email, :date_commenced, :date_completed, :location, :date_commissioned, CURRENT_TIMESTAMP)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date_commenced', $date_commenced);
        $stmt->bindParam(':date_completed', $date_completed);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':date_commissioned', $date_commissioned);

        if($stmt->execute()){
          return $stmt;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
      }

        public function viewMyPosts(){
          //
          $sql = "SELECT * FROM `Post`";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          return $stmt;
        }

        public function comment($post_id, $comment_body){
            //
            $sql = "";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function reactToPost($post_id, $sentiment){
            //
            $sql = "";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function logout(){
            //
            $sql = "";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function changeName($first_name, $middle_name, $last_name){
            //
            $sql = "";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function changePassword($old_password, $new_password){
            //
            $sql = "";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function changeAddress(){
            //
            $sql = "INSERT INTO `Address`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function follow($user_email){
            //
            $sql = "INSERT INTO";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function changeProfilePicture(){
          //
          $sql = "";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          return $stmt;
        }
    }
