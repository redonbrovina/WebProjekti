<?php 

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("location: index.php");
}

$userId = $_GET['id'];

include_once "../Repositories/UserRepository.php";
$userRepository = new UserRepository();
$user = $userRepository->getUserById($userId);

if(isset($_POST['editBtn'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $userRepository->updateUser($id, $username, $password, $gender, $email, $phone, $role);
    header("location: host.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous</title>
    <style>
        body{
            padding: 1rem;
            font-family: Marcellus, sans-serif;
            text-align:center;
        }

        input{
            padding: 0.6rem;
            font-size: 1rem;
            width: 50%;
            display: block;
            margin:auto;
        }

        form{
            display:flex;
            flex-direction: column;
            gap: 0.6rem;
            width: 100%;
        }

        input[type='submit']{
            color: white;
            background-color: #0d47a1;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 600;
            font-family: Marcellus, sans-serif;
            height: 3.125rem;
            cursor: pointer;
            width: 51.5%;
        }

    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <h2>Edit User Data</h2>
    <form action="" method="post">
        <input type="text" name="id" value="<?=$user['id']?>" readonly> <br><br>
        <input type="text" name="username" value="<?=$user['username']?>"> <br><br>
        <input type="text" name="password" value="<?=$user['password']?>"> <br><br>
        <input type="text" name="gender" maxlength="1" value="<?=$user['gender']?>" > <br><br>
        <input type="text" name="email" value="<?=$user['email']?>" > <br><br>
        <input type="text" name="phone" value="<?=$user['phone']?>" > <br><br>
        <input type="text" name="role" value="<?=$user['role']?>" > <br><br>
        <input type="submit" name="editBtn" value="Save Changes" > <br><br>
    </form>
</body>
</html>
