<?php
class client {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    // Getting restaurants for index page
    public function getRestaurants() {
        $this->db->query("SELECT name, id FROM restaurants");

        $results = $this->db->resultSet();

        return $results;
    }

    // Getting pizzas for restaurant page
    public function getRestaurantPizzas($id) {
        $this->db->query("SELECT title, ingredients, id FROM pizzas WHERE restaurant_id = :id ORDER BY created_at");

        $this->db->bind(':id', $id);

        if ($pizzas = $this->db->resultSet()) {
            return $pizzas;
        }
    }

    // Search 
    public function searchPizza($res_id, $searchContent) {
        $this->db->query("SELECT title, ingredients, id FROM pizzas WHERE restaurant_id = :restaurant_id AND title LIKE :search ORDER BY created_at");

        $this->db->bind('restaurant_id', $res_id);
        $this->db->bind('search', '%' . $searchContent . '%');

        $result = $this->db->resultSet();
        return $result;
    }

    // Details
    public function getDetails($id) {
        $this->db->query('SELECT * FROM pizzas WHERE id = :id');

        $this->db->bind('id', $id);

        if ($pizza = $this->db->single()) {
            $this->db->query('SELECT name FROM restaurants WHERE id = :id');
            $this->db->bind(':id', $pizza->restaurant_id);
            $res_name = $this->db->single();
            $results = [
                'pizza' => $pizza,
                'res_name' => $res_name
            ];
            return $results;
        } else {
            return false;
        }
    }

    // Fetch cart items

    public function cartItems($ids) {
        try {
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                // Creates a placeholders of (?) to be used in the query.
                $placeholders = implode(',', array_fill(0, count($ids), '?'));

                $this->db->query("SELECT title, ingredients, id FROM pizzas WHERE id IN ($placeholders) ORDER BY created_at");

                foreach ($ids as $index => $id) {
                    $this->db->bind($index + 1, $id);
                }

                $result = $this->db->resultSet();

                return $result;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            echo "Error: " . $e->getMessage();
        }
    }

    // Random driver.
    public function randDriver() {
        try {

            $this->db->query("SELECT id from drivers");

            $result = $this->db->resultSet();

            return $result;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            echo "Error: " . $e->getMessage();
        }
    }

    // Place order.
    public function placeOrder($client_id, $res_id, $pizzas_ids, $rand_driver_id) {

        // Clean data 
        $client_id = htmlspecialchars(strip_tags($client_id));
        $res_id = htmlspecialchars(strip_tags($res_id));
        $pizzas_ids = htmlspecialchars(strip_tags($pizzas_ids));
        $driver = htmlspecialchars(strip_tags($rand_driver_id));

        
       $this->db->query("INSERT INTO orders (client_id, restaurant_id, driver_id, order_details) VALUES (:client_id, :res_id, :driver, :pizzas_ids)");

       $this->db->bind(":client_id", $client_id);
       $this->db->bind(":res_id", $res_id);
       $this->db->bind(":driver", $driver);
       $this->db->bind(":pizzas_ids", $pizzas_ids);


        $this->db->execute();
    }
}