<?php 

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("location: index.php");
}

$serviceId=$_GET['id'];

include_once "../Repositories/ServiceRepository.php";

$serviceRepository=new ServiceRepository();
$serviceRepository->deleteService($serviceId);

header("location:host.php");

?>