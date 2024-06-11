<?php
class Restaurant
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Bring restaurant pizzas to dashboard.
    public function getPizzas($id)
    {
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT * FROM pizzas WHERE restaurant_id = :id');

        $this->db->bind(':id', $id);

        try {
            if ($result = $this->db->resultSet()) {
                return $result;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            return "Error: " . $e->getMessage();
        }
    }

    // Remove pizza from restaurant dashboard.
    function remove($id)
    {
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        $this->db->query('DELETE FROM pizzas WHERE id = :id');

        $this->db->bind(':id', $id);

        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Get single pizza.
    public function getSinglePizza($pizza_id)
    {
        // Used to check unauthorized access.
        $res_id = $_SESSION['user_id'];

        // Clean data.
        $pizza_id = filter_var(htmlspecialchars(strip_tags($pizza_id)), FILTER_VALIDATE_INT);
        $res_id = filter_var(htmlspecialchars(strip_tags($res_id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT * FROM pizzas WHERE id = :id AND restaurant_id = :res_id');

        $this->db->bind('id', $pizza_id);
        $this->db->bind('res_id', $res_id);

        try {
            return $this->db->single();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Update pizza details.
    public function updatePizza($id, $title, $ing)
    {
        // Clean data 
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);
        $title = htmlspecialchars(strip_tags($title));
        $ing =  htmlspecialchars(strip_tags($ing));

        // Prepare query statement.
        $this->db->query('UPDATE pizzas 
        SET title = :title, ingredients = :ing 
        WHERE id = :id');

        // Bind the data.                  
        $this->db->bind(':id', $id);
        $this->db->bind(':title', $title);
        $this->db->bind(':ing', $ing);

        try {
            $this->db->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Get all restaurant orders.
    public function getOrders($id)
    {
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT * from orders WHERE restaurant_id = :id');
        $this->db->bind(':id', $id);

        try {
            return $this->db->resultSet();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Customer Name.
    public function customerName($id)
    {
        // Clean data.
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        // Set query.
        $this->db->query('SELECT name FROM clients WHERE id = :id');
        $this->db->bind(':id', $id);

        try {
            return $this->db->single();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    // Driver Name.
    public function driverName($id)
    {
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT name FROM drivers WHERE id = :id');
        $this->db->bind(':id', $id);

        try {
            return $this->db->single();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Get pizza for orders.
    public function getOrderPizza($id)
    {
        $id = filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT title FROM pizzas WHERE id = :id');
        $this->db->bind(':id', $id);

        try {
            return $this->db->single();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Get single order.
    public function getSingleOrder($order_id)
    {
        // Used to make sure a restaurant can't access other restaurant orders. 
        $restaurant_id =  $_SESSION['user_id'];
        // Clean data.
        $order_id = filter_var(htmlspecialchars(strip_tags($order_id)), FILTER_VALIDATE_INT);
        $restaurant_id = filter_var(htmlspecialchars(strip_tags($restaurant_id)), FILTER_VALIDATE_INT);

        $this->db->query('SELECT id, order_details, order_status FROM orders WHERE id = :id AND restaurant_id = :restaurant_id');
        $this->db->bind(':id', $order_id);
        $this->db->bind(':restaurant_id', $restaurant_id);

        try {
            return $this->db->single();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Get pizza title.
    public function getSinglePizzaTitle($id)
    {
        $this->db->query('SELECT title FROM pizzas WHERE id = :id');

        $this->db->bind(':id', $id);
        try {
            return $this->db->single();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
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
            return 'Error: ' . $e->getMessage();
        }
    }

    // Add pizza to DB.
    public function addPizza($res_id, $pizza_details)
    {
        // Clean data.
        $id = filter_var(htmlspecialchars(strip_tags($res_id)), FILTER_VALIDATE_INT);
        $title = htmlspecialchars(strip_tags($pizza_details['title']));
        $ing = htmlspecialchars(strip_tags($pizza_details['ing']));
        $price = filter_var(htmlspecialchars(strip_tags($pizza_details['price'])), FILTER_VALIDATE_INT);

        // Query.
        $this->db->query('insert into pizzas(restaurant_id, title, ingredients, price) VALUES(:id, :title, :ing, :price);');

        // Binding.
        $this->db->bind(':id', $id);
        $this->db->bind(':title', $title);
        $this->db->bind(':ing', $ing);
        $this->db->bind(':price', $price);

        // Query execution.
        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
