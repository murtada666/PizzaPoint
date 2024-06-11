<?php
class admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Find user by email - used to find existing emails.
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM clients WHERE email = :email
                          UNION 
                          SELECT * FROM restaurants WHERE email = :email
                          UNION 
                          SELECT * FROM admins WHERE email = :email
                          UNION 
                          SELECT * FROM drivers WHERE email = :email');
        // Bind values.
        $this->db->bind(':email', $email);

        try {
            // Check row.
            if ($this->db->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $e) {
            // Return an error message indicating the query failed.
            return 'Error: ' . $e->getMessage();
        }
    }

    // Fetch count of selected a table.
    public function tableCount($table_name)
    {
        // Table name is dynamic.
        $this->db->query("SELECT id FROM " . $table_name);

        try {
            if ($count = $this->db->rowCount()) {
                return $count;
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Best driver.
    public function bestDriver()
    {
        $this->db->query("SELECT name 
        FROM drivers 
        WHERE id = (
            SELECT driver_id
            FROM orders 
            WHERE order_status = 4 
            GROUP BY driver_id 
            ORDER BY COUNT(order_details) DESC 
            LIMIT 1
        );
        ");

        try {
            if ($result = $this->db->single()) {
                return $result;
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Best restaurant.
    public function bestRestaurant()
    {
        $this->db->query("SELECT name
        FROM restaurants 
        WHERE id = (
            SELECT restaurant_id 
            FROM `orders` 
            GROUP BY restaurant_id 
            ORDER by COUNT(restaurant_id) DESC 
            LIMIT 1);");

        try {
            if ($result = $this->db->single()) {
                return $result;
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Best client.
    public function bestClient()
    {
        $this->db->query("SELECT name
        FROM clients 
        WHERE id = (
            SELECT client_id 
            FROM `orders` 
            GROUP BY client_id 
            ORDER by COUNT(client_id) DESC 
            LIMIT 1);");

        try {
            if ($result = $this->db->single()) {
                return $result;
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // Register a selected account type,
    public function registerAccount($table_name, $data)
    {
        // Hash Password.
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Table name is dynamic.
        $this->db->query("INSERT INTO " . $table_name . " (name, email, password) VALUES(:name, :email, :password)");

        // Bind values  
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        try {
            // Execute.
            if ($this->db->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
