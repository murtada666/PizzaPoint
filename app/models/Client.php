<?php 
class client{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }
    // Getting restaurants for index page
    public function getRestaurants(){
        $this->db->query("SELECT name, id FROM restaurants");

        $results = $this->db->resultSet();

        return $results;
    }

    // Getting pizzas for restaurant page
    public function getRestaurantPizzas($id) {
        $this->db->query("SELECT title, ingredients, id FROM pizzas WHERE restaurant_id = :id ORDER BY created_at");

        $this->db->bind(':id', $id);


        if($pizzas = $this->db->resultSet()) {
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

        if($pizza = $this->db->single()) {
            $this->db->query('SELECT name FROM restaurants WHERE id = :id');
            $this->db->bind('id', $pizza->restaurant_id);
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
                // Create an associative array of named placeholders
                $namedPlaceholders = array_map(function ($index) {
                    return ":id$index";
                }, array_keys($ids));
                
                // Create a string of named placeholders separated by commas
                $placeholders = implode(', ', $namedPlaceholders);
                
                $this->db->query("SELECT title, ingredients, id FROM pizzas WHERE id IN ($placeholders) ORDER BY created_at");
    
                // Bind parameters using named placeholders
                foreach ($ids as $index => $id) {
                    $this->db->bind(":id$index", $id);
                }
    
                $result = $this->db->resultSet();

                return $result;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            echo "Error: " . $e->getMessage();
        }
    }
}