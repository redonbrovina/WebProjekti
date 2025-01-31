<?php

class Service {
    private $id;
    private $name;
    private $img;
    private $price;
    private $description;

    public function __construct($id, $name, $img, $price, $description){
        $this->id = $id;
        $this->name = $name;
        $this->img = $img;
        $this->price = $price;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getImg() {
        return $this->img;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

}

?>