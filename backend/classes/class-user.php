<?php
class User
{

    // Connection
    private $db;

    // Tables
    private $users_table = "users";

    // Db connection
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login($email, $password)
    {
        try {
            $q =  $this->db->prepare("SELECT * FROM $this->users_table 
                      WHERE user_email = :user_email LIMIT 1");
            $q->bindValue(':user_email', $email);
            $q->execute();
            $row = $q->fetch();
            if (!$row) {
                return "Wrong email";
            }
            if (password_verify($password, $row['user_password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_last_name'] = $row['user_last_name'];
                header('Location: /');
            }
            return "Wrong password";
        } catch (Exception $ex) {
            echo "Database could not be connected: " . $ex->getMessage();
        }
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
