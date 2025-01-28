<?php 

include_once 'databaseConnection.php';

class UserRepository {
    private $connection;

    function __construct() {
        $conn = new Database();
        $this->connection = $conn->startConnection(); 
    }

    function insertUser($user):bool{
        $conn = $this->connection;

        $inputPass = $user->getPassword();

        $id = $user->getId();
        $username = $user->getUsername();
        $password = password_hash($inputPass, PASSWORD_DEFAULT);
        $gender = $user->getGender();
        $email = $user->getEmail();
        $phone = $user->getPhone();

        try{
            $sql = "INSERT INTO user (id, username, password, gender, email, phone) VALUES (:id, :username, :password, :gender, :email, :phone)";
            $statement = $conn->prepare($sql);


            $statement->bindParam(':id', $id);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':phone', $phone);

            $statement->execute();
            
            return true;
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage(); 
            return false;
        }

        return false;
    }

    function getAllUsers() {
        $conn = $this->connection;
        $sql = "SELECT * FROM user";

        $statement = $conn->query($sql);

        $users = $statement->fetchAll();
        
        return $users;
    }

    function getUserById($id) {
        $conn = $this->connection;
        $sql = "SELECT * FROM user WHERE id = '$id'";

        $statement = $conn->query($sql);

        $user = $statement->fetch();

        return $user;
    }
}

?>