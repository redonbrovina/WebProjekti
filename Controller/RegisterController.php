<?php 

include_once '../Model/User.php';
include_once '../Model/Service.php';
include_once '../Repositories/UserRepository.php';
include_once '../Repositories/ServiceRepository.php';

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
        exit;
    }

    $id = $username . rand(100, 999);
    $user = new User($id, $username, $password, $gender, $email, $phone);

    $userRep = new UserRepository();

    $userRep->insertUser($user);

    $url = '../View/form.php';

    if($userRep){
        sleep(3);
        header("Location: $url");
        exit;
    }else{
        echo "<script>alert('Registration failed!')</script>";
    }
}


if(isset($_POST["registerServiceBtn"])){
    if(empty($_POST["name"]) || empty($_POST["img"]) || empty($_POST["price"]) ||
    empty($_POST["description"])){
        echo "Fill All Fields!";
        exit;
    }else{
        $name = $_POST['name'];
        $img = $_POST['img'];
        $price = $_POST['price'];
        $description = $_POST['description'];
    }

    $id = $name . rand(100, 999);
    $service = new Service($id, $name, $img, $price, $description);

    $serviceRep = new ServiceRepository();

    $serviceRep->insertService($service);
    $url = "../View/host.php";

    if($serviceRep){
        sleep(1);
        header("Location: $url");
        exit;
    }else{
        echo "<script>alert('Registration Failed!')</script>";
    }
}
?>