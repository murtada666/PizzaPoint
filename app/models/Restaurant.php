<?php
class Restaurant {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Bring restaurant pizzas to dashboard.
    public function getPizzas($id) {
        $this->db->query('SELECT * FROM pizzas WHERE restaurant_id = :id');

        $this->db->bind(':id', $id);

        try {
            if ($result = $this->db->resultSet()) {
                return $result;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            echo "Error: " . $e->getMessage();
        }
    }

    // Remove pizza from restaurant dashboard.
    function remove($id) {
        $this->db->query('DELETE FROM pizzas WHERE id = :id');

        $this->db->bind(':id', $id);

        try {
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Get single pizza.
    public function getPizza($id) {
        $this->db->query('SELECT * FROM pizzas WHERE id = :id');

        $this->db->bind('id', $id);
        try {
            return $this->db->single();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Update pizza details.
    public function updatePizza($id, $title, $ing) {

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

        try{
            $this->db->execute();
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
