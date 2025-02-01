<?php


session_start();

if(!isset($_SESSION['role'])){
    header("location: index.php");
}

$orderId = $_GET['id'];

include_once "../Repositories/OrderRepository.php";

$Repository=new OrderRepository();
$Repository->deleteOrder($orderId);


if($_SESSION['role'] == 'user'){
    header("location:userDashboard.php");
}else{
    header("location:host.php");
}

?>
