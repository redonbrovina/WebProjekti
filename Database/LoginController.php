<?php 
include_once 'User.php';
include_once 'UserRepository.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userRep = new UserRepository();
    $users = $userRep->getAllUsers();

    $url = '../index.html';

    foreach($users as $user){
        if($user['username'] == $username){
            if($user['id' == 1]){
                if($password == $user['password']){
                    header("Location: $url");           
                    exit;
                }
            }
            if(password_verify($password, $user['password'])) {
                header("Location: $url");           
                exit;
            }else{
                break;
            }
        }
    }

    echo "<script>
            alert('Username or password is incorrect');
            window.location.href = '../form.php';
            </script>";
}





?>