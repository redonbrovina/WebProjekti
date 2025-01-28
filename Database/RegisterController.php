<?php 

include_once 'User.php';
include_once 'UserRepository.php';

if(isset($_POST["registerBtn"])){
    if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["gender"]) ||
    empty($_POST["email"])){
        echo "Fill All Fields!";
    }
    elseif(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
    }else{
        echo "Enter the correct Email Format!";
    }

    $id = $username . rand(100, 999);
    $user = new User($id, $username, $password, $gender, $email, $phone);

    $userRep = new UserRepository();

    $userRep->insertUser($user);

    $url = '../form.php';

    if($userRep){
        sleep(3);
        header("Location: $url");
        exit;
    }else{
        echo "<script>alert('Registration failed!')</script>";
    }

}
?>