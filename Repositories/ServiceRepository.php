<?php

include_once "../Database/databaseConnection.php";

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
        $conn = $this->connection;
        $sql = "SELECT * FROM service";

        $statement = $conn->query($sql);

        $services = $statement->fetchAll();

        return $services;
    }

    function getServiceById($id){
        $conn = $this->connection;
        $sql = "SELECT * FROM service WHERE id = '$id'";

        $statement = $conn->query($sql);

        $service = $statement->fetch();
        return $service;
    }

    function updateService($id, $name, $img, $price, $description){
        $conn = $this->connection;

        $sql = "UPDATE service SET name=?, img=?, price=?, description=? WHERE id=?";

        $statement=$conn->prepare($sql);
        $statement->execute([$name, $img, $price, $description, $id]);
    }

    function deleteService($id){
        $conn = $this->connection;

        $sql = "DELETE FROM service where id=?";

        $statement = $conn->prepare($sql);
        $statement->execute([$id]);
    }

    function getServicePriceById($id){
        $conn = $this->connection;
        $sql = "SELECT price FROM service WHERE id = '$id'";

        $statement = $conn->query($sql);

        $price = $statement->fetch();
        return $price;
    }

    function getServiceNamebyId($id){
        $conn = $this->connection;
        $sql = "SELECT name FROM service WHERE id = '$id'";

        $statement = $conn->query($sql);

        $name = $statement->fetch();
        return $name;
    }
}

?>