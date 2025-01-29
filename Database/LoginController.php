<?php 
include_once 'User.php';
include_once 'UserRepository.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userRep = new UserRepository();
    $isTrue = $userRep->checkLogin($username, $password);
    $user = $userRep->getUserByUsername($username);
    
    $url = '../index.php';
    
    if($isTrue){
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: $url");
        exit;
    }

    echo "<script>
            alert('Username or Password is incorrect');
            window.location.href = '../form.php';
            </script>";
}





?>