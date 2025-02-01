<?php 

session_start();

include_once "../Repositories/OrderRepository.php";
include_once "../Repositories/ServiceRepository.php";
include_once "../Model/Order.php";


if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}

$serviceId = isset($_GET['serviceid']) ? $_GET['serviceid'] : null;
$productId = isset($_GET['productid']) ? $_GET['productid'] : null;
$userId = $_SESSION['user_id'];

$OrderRep = new OrderRepository();

$name = $_SESSION['username'];

$newOrder = new Order($id, $userId, $productId, $serviceId);

$OrderRep->insertOrder($newOrder);

if($serviceId){
    header('Location: services.php');
}else{
    header('Location: shop.html');
}


?>