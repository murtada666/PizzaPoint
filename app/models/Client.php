<?php
class client
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    // Getting restaurants for index page.
    public function getRestaurants()
    {
        $this->db->query("SELECT name, id FROM restaurants");

        $results = $this->db->resultSet();

        return $results;
    }

    // Check if restaurant exist in DB to handle 404.
    public function doesResExist($id)
    {
        // Clean data 
        $id =  filter_var(htmlspecialchars(strip_tags($id)), FILTER_VALIDATE_INT);

        $this->db->query("SELECT id FROM restaurants WHERE id = :id");

        $this->db->bind('id', $id);

        try {
            // In case restaurant is not exist.
            if ($this->db->single()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Getting pizzas for restaurant page
    public function getRestaurantPizzas($id)
    {
        $this->db->query("SELECT * FROM pizzas WHERE restaurant_id = :id ORDER BY created_at");

        $this->db->bind(':id', $id);

        if ($pizzas = $this->db->resultSet()) {
            return $pizzas;
        }
    }

    // Restaurant name.
    public function resName($id)
    {
        $this->db->query("SELECT name FROM restaurants WHERE id = :id");

        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    // Search 
    public function searchPizza($res_id, $searchContent)
    {
        $this->db->query("SELECT * FROM pizzas WHERE restaurant_id = :restaurant_id AND title LIKE :search ORDER BY created_at");

        $this->db->bind('restaurant_id', $res_id);
        $this->db->bind('search', '%' . $searchContent . '%');

        return $this->db->resultSet();
    }

    // Details
    public function getDetails($id)
    {
        // Fetch the pizza data.
        $this->db->query('SELECT * FROM pizzas WHERE id = :id');

        $this->db->bind('id', $id);
        // Fetch the pizza restaurant name.
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

    public function cartItems($ids)
    {
        try {
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                // Creates a placeholders of (?) to be used in the query.
                $placeholders = implode(',', array_fill(0, count($ids), '?'));

                $this->db->query("SELECT * FROM pizzas WHERE id IN ($placeholders) ORDER BY created_at");

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

    // Total price for cart page.
    public function total($ids)
    {
        try {
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                // Creates a placeholders of (?) to be used in the query.
                $placeholders = implode(',', array_fill(0, count($ids), '?'));

                $this->db->query("SELECT SUM(price) as total FROM pizzas WHERE id IN ($placeholders) ORDER BY created_at");

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
    public function randDriver()
    {
        try {

            $this->db->query("SELECT id from drivers");

            $result = $this->db->resultSet();
            // Random id index.
            $rand_index = array_rand($result);
            // Id stored in an array.
            $rand_id = get_object_vars($result[$rand_index]);
            // Single value.
            $id = $rand_id['id'];

            return $id;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            echo "Error: " . $e->getMessage();
        }
    }

    // Place order.
    public function placeOrder($client_id, $res_id, $pizzas_ids, $driver_id, $total)
    {

        // Clean data 
        $client_id =  filter_var(htmlspecialchars(strip_tags($client_id)), FILTER_VALIDATE_INT);
        $res_id =  filter_var(htmlspecialchars(strip_tags($res_id)), FILTER_VALIDATE_INT);
        $pizzas_ids = htmlspecialchars(strip_tags($pizzas_ids));
        $driver_id =  filter_var(htmlspecialchars(strip_tags($driver_id)), FILTER_VALIDATE_INT);
        $total =  filter_var(htmlspecialchars(strip_tags($total)), FILTER_VALIDATE_INT);

        $this->db->query("INSERT INTO orders (client_id, restaurant_id, driver_id, order_details, total) VALUES (:client_id, :res_id, :driver, :pizzas_ids, :total)");

        $this->db->bind(":client_id", $client_id);
        $this->db->bind(":res_id", $res_id);
        $this->db->bind(":driver", $driver_id);
        $this->db->bind(":pizzas_ids", $pizzas_ids);
        $this->db->bind(":total", $total);

        try {
            $this->db->execute();
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            echo "Error: " . $e->getMessage();
        }
    }
}
