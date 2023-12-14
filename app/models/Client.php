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
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Creates a placeholders of (?) to be used in the query.
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            // $placeholders = implode(',', $ids);

            // die($placeholders);
        
            $this->db->query("SELECT title, ingredients, id FROM pizzas WHERE id IN ($placeholders) ORDER BY created_at");
            print_r($ids);
            foreach ($ids as $index => $id) {
                $this->db->bind($index + 1, $id);
            }

            $result = $this->db->resultSet();

            return $result;
        }
    }
}