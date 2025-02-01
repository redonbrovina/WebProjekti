<?php 

include_once "../Database/databaseConnection.php";

class OrderRepository {
    private $connection;

    public function __construct() {
        $conn = new Database();
        $this->connection = $conn->startConnection();
    }

    function insertOrder($order) :bool{
        $conn = $this->connection;

        $id = $order->getId();
        $userId = $order->getUserId();
        $productId = $order->getProductId();
        $serviceId = $order->getServiceId();
        $quantity = $order->getQuantity();

        try{
            $query = "SELECT id, quantity FROM orders WHERE user_id = ? AND (product_id = ? OR service_id = ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$userId, $productId, $serviceId]);
            
            $existingOrder = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingOrder) {
                $newQuantity = $existingOrder['quantity'] + $quantity;
                $updateQuery = "UPDATE orders SET quantity = ? WHERE id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->execute([$newQuantity, $existingOrder['id']]);
                return true;
            }
            else{
                $sql = "INSERT INTO orders (id, user_id, product_id, service_id, quantity) VALUES (:id, :user_id, :product_id, :service_id, :quantity)";
                $statement = $conn->prepare($sql);

                $statement->bindParam(':id', $id);
                $statement->bindParam(':user_id', $userId);
                $statement->bindParam(':product_id', $productId);
                $statement->bindParam(':service_id', $serviceId);
                $statement->bindParam(':quantity', $quantity);

                $statement->execute();
                return true;
            }
        }catch(PDOException $e){
            echo "Insert Order Error: " . $e->getMessage();
            return false;
        }
    }

    function getAllOrders() {
        $conn = $this->connection;
        $sql = "SELECT * FROM orders";

        $statement = $conn->query($sql);

        $orders = $statement->fetchAll();

        return $orders;
    }

    function getOrdersByUserId($userId) {
        $conn = $this->connection;
        $sql = "SELECT * FROM orders WHERE user_id = '$userId'";

        $statement = $conn->query($sql);

        $orders = $statement->fetchAll();
        return $orders;
    }

    function updateOrder() {

    }

    function deleteOrder($id) {
        $conn = $this->connection;

        $sql = "DELETE FROM orders where id=?";

        $statement = $conn->prepare($sql);
        $statement->execute([$id]);
    }

    function deleteOrdersByUserId($userId) {
        $conn = $this->connection;

        $sql = "DELETE FROM orders where user_id=?";

        $statement = $conn->prepare($sql);
        $statement->execute([$userId]);
    }
}



?>