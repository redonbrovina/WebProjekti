<?php

class Order {
    private $id;
    private $quantity;
    private $userId;
    private $productId;
    private $serviceId;
    private $order_date;

    public function __construct($id, $userId, $productId = null, $serviceId = null, $quantity = 1, $order_date = null){
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->serviceId = $serviceId;
        $this->quantity = $quantity;
        $this->order_date = $order_date;
    }

    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getProductId() {
        return $this->productId;
    }

    function getServiceId() {
        return $this->serviceId;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getOrderDate() {
        return $this->order_date;
    }
}

?>