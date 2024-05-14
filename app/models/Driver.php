<?php
class Driver
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    // Fetch all driver orders.
    public function getOrders($id)
    {
        // Clean data.
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);
        // Set query.
        $this->db->query('SELECT * FROM orders WHERE driver_id = :id');
        // Bind data.
        $this->db->bind(':id', $id);
        try {
            if ($result = $this->db->resultSet())
                return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Customer Name.
    public function customerName($id)
    {
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT name FROM clients WHERE id = :id');
        $this->db->bind(':id', $id);

        try {
            return $this->db->single();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    // Restaurant Name.
    public function restaurantName($id)
    {
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT name FROM restaurants WHERE id = :id');
        $this->db->bind(':id', $id);

        try {
            return $this->db->single();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Get single order.
    public function getSingleOrder($order_id)
    {
        $driver_id = $_SESSION['user_id'];
        $order_id = filter_var(htmlspecialchars(strip_tags($order_id)), FILTER_VALIDATE_INT);
        $driver_id = filter_var(htmlspecialchars(strip_tags($driver_id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT id, order_details, order_status FROM orders WHERE id = :id AND driver_id = :driver_id');

        $this->db->bind(':id', $order_id);
        $this->db->bind(':driver_id', $driver_id);

        try {
            return $this->db->single();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Get pizza title.
    public function getSinglePizzaTitle($id)
    {
        $this->db->query('SELECT title FROM pizzas WHERE id = :id');

        $this->db->bind('id', $id);
        try {
            return $this->db->single();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

        // Update order status.
        public function updateOrderStatus($order_id, $status)
        {
            $order_id = filter_var(htmlspecialchars(strip_tags($order_id)), FILTER_VALIDATE_INT);
            $status =  htmlspecialchars(strip_tags($status));
    
            $this->db->query('UPDATE orders
            SET order_status = :status
            WHERE id = :order_id;');
    
            $this->db->bind('order_id', $order_id);
            $this->db->bind('status', $status);
            try {
                $this->db->execute();
                return true;
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
}
