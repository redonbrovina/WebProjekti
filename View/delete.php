<?php 

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("location: index.php");
}

$userId=$_GET['id'];

include_once "../Repositories/UserRepository.php";

$userRepository=new UserRepository();
$userRepository->deleteUser($userId);

header("location:host.php");

?>