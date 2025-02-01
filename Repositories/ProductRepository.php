<?php 

include_once "../Database/databaseConnection.php";

class ProductRepository {
    private $connection;

    public function __construct() {
        $conn = new Database();
        $this->connection = $conn->startConnection();
    }

    function insertProduct() {

    }

    function getAllProducts() {

    }

    function getProductById(){

    }

    function updateProduct() {

    }

    function deleteProduct() {
        
    }

}




?>