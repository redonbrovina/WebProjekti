<?php

include_once "databaseConnection.php";

class ServiceRepository {

    private $connection;

    public function __construct(){
        $conn = new Database();
        $this->connection = $conn->startConnection();
    }

    function insertService($service):bool{
        $conn = $this->connection;

        $id = $service->getId();
        $name = $service->getName();
        $img = $service->getImg();
        $price = $service->getPrice();
        $description = $service->getDescription();
        
        try{
            $sql = "INSERT INTO service (id, name, img, price, description) VALUES (:id, :name, :img, :price, :description)";
            $statement = $conn->prepare($sql);
            
            $statement->bindParam(':id', $id);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':img', $img);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':description', $description);

            $statement->execute();
            return true;
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    function getAllServices() {

    }

    function getServiceById($id){

    }

    function updateService(){

    }

    function deleteService(){
    
    }
}

?>