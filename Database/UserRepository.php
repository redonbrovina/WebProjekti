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
            $sql = "INSERT INTO user (id, username, password, gender, email, phone) VALUES (:id, :username, :pass, :gender, :email, :phone)";
            $statement = $conn->prepare($sql);


            $statement->bindParam(':id', $id);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':pass', $password);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':phone', $phone);

            $statement->execute();
            
            return true;
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage(); 
            return false;
        }
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

    public function getUserByUsername($username){
        $conn = $this->connection;
        $sql = "SELECT * FROM user WHERE username = '$username'";

        $statement = $conn->query($sql);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }


    function checkLogin($username, $inputPassword) {
        $conn = $this->connection;

        $sql = "SELECT password FROM user WHERE username = '$username'";
        $stmt = $conn->query($sql);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        $pass = $user['password'];

        if (password_verify($inputPassword, $pass) || $inputPassword == $pass) {
            return true;
        } else {
            return false;
        }
    }

    function updateUser($id, $username, $password, $gender, $email, $phone){
        $conn = $this->connection;

        $sql = "UPDATE user SET username=?, password=?, gender=?, email=?, phone=? WHERE id=?";

        $statement=$conn->prepare($sql);
        $statement->execute([$username, $password, $gender, $email, $phone, $id]);
    }

    function deleteUser($id){
        $conn = $this->connection;
        $sql = "DELETE FROM user WHERE id=?";
        $statement=$conn->prepare($sql);

        $statement->execute([$id]);
    }
}

?>