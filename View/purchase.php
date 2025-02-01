<?php 

session_start();

if(!isset($_SESSION['role'])){
    header("location: index.php");
}

$userId = $_SESSION['user_id'];

include_once "../Repositories/OrderRepository.php";

$Repository=new OrderRepository();
$Repository->deleteOrdersByUserId($userId);


header("location:userDashboard.php");

?>