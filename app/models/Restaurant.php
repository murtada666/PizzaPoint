<?php
class Restaurant {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPizzas($id) {
        $this->db->query('SELECT * FROM pizzas WHERE restaurant_id = :id');

        $this->db->bind(':id', $id);

        try {
            if($result = $this->db->resultSet()) {

                return $result;
            } else {
                die('Something went wrong');
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            echo "Error: " . $e->getMessage();
        }

    }
}