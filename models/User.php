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
                User.id as id,
                CONCAT(Name.first_name, ' ',
                Name.middle_name, ' ',
                Name.last_name) as name,
                User.is_admin as admin
                FROM User
              JOIN Name ON Name.id = User.id
              WHERE
                User.email = :email
                AND
                User.password = :password
            " ;
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', md5($password));
            if($stmt->execute()){
              return $stmt;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
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
        if($stmt->execute()) {
          return $stmt;
        }
        return false;
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
        if($stmt->execute()) {
          return $stmt;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
      }

      public function postAchievement($email, $date_commenced, $date_completed, $location, $date_commissioned){
        //
        $sql = "INSERT INTO `Post`(`user_email`, `date_commenced`, `date_completed`, `location`, `date_commissioned`)
                VALUES(:email, :date_commenced, :date_completed, :location, :date_commissioned)";
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

        public function viewMyPosts($email){
          //
          $query = "SELECT
                      Post.date_commenced as started,
                      Post.date_completed as completed,
                      Post.date_commissioned as commissioned,
                      Post.location as location,
                      Post.time_posted as posted,
                      Post.description as description
                          FROM `Post` WHERE Post.user_email = :email";
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(':email', $email);

          if($stmt->execute()) {
            return $stmt;
          }
          printf("Error: %s.\n", $stmt->error);
          return false;
        }

        public function commentOnPost($user_id, $post_id, $body){
            //
            $sql = "INSERT INTO `PostComment`(`user_id`, `post_id`, `body`) VALUES(:user_id, :post_id, :body)";
            $stmt = $this->conn->prepare($sql);
          $stmt->bindParam(':user_id', $user_id);
          $stmt->bindParam(':post_id', $post_id);
          $stmt->bindParam(':body', $body);

          if($stmt->execute()) {
            return $stmt;
          }
          printf("Error: %s.\n", $stmt->error);
          return false;
        }

        public function reactToPost($post_id, $sentiment){
            //
            $sql = "";
            $stmt = $this->conn->prepare($sql);

          if($stmt->execute()) {
            return $stmt;
          }
          printf("Error: %s.\n", $stmt->error);
          return false;
        }

        public function changeName($id, $first_name, $middle_name, $last_name){
            //
            $query = "UPDATE `Name` SET
                        `first_name` = :first_name,
                        `middle_name` = :middle_name,
                        `last_name` = :last_name
                         WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':middle_name', $middle_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()) {
              return $stmt;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function changePassword($id, $old_password, $new_password){
            //
            $query = "UPDATE `User` SET `password` = :new_password WHERE id = :id AND password = :old_password";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':old_password', $old_password);
            $stmt->bindParam(':new_password', $new_password);
            if($stmt->execute()) {
              return $stmt;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function changeAddress(){
            //
            $sql = "INSERT INTO `Address`";
            $stmt = $this->conn->prepare($sql);

            if($stmt->execute()) {
              return $stmt;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function follow($user_email){
            //
            $sql = "INSERT INTO";
            $stmt = $this->conn->prepare($sql);

            if($stmt->execute()) {
              return $stmt;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function changeProfilePicture(){
          //
          $sql = "INSERT INTO `ProfilePicture() VALUES();`";
          $stmt = $this->conn->prepare($sql);

          if($stmt->execute()) {
            return $stmt;
          }
          printf("Error: %s.\n", $stmt->error);
          return false;
        }

      public function logout(){
        //
        $sql = "";
        $stmt = $this->conn->prepare($sql);

        if($stmt->execute()) {
          return $stmt;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
      }
    }
