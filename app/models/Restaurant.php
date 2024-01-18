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
}
