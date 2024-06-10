<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Register user
    public function register($data)
    {
        // Hash Password.
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        // Check account type.
        $this->db->query('INSERT INTO clients (name, email, password) VALUES(:name, :email, :password)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $hashed_password);

        try {
            // Execute
            if ($this->db->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            return [
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    // Login user.
    public function login($email, $password)
    {
        // Match email account type with its corresponding table.
        $this->db->query('SELECT id, account_type FROM clients WHERE email = :email
                          UNION 
                          SELECT id, account_type FROM restaurants WHERE email = :email
                          UNION 
                          SELECT id, account_type FROM drivers WHERE email = :email
                          UNION 
                          SELECT id, account_type FROM admins WHERE email = :email');

        $this->db->bind(':email', $email);
        try {
            $sub_result = $this->db->single();
        } catch (PDOException $e) {
            return [
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }

        // Check the right table.
        if ($sub_result->account_type == 'client') {
            $this->db->query('SELECT * FROM clients WHERE id = :id');
        } elseif ($sub_result->account_type == 'restaurant') {
            $this->db->query('SELECT * FROM `restaurants` WHERE id = :id');
        } elseif ($sub_result->account_type == 'driver') {
            $this->db->query('SELECT * FROM drivers WHERE id = :id');
        } elseif ($sub_result->account_type == 'admin') {
            $this->db->query('SELECT * FROM admins WHERE id = :id');
        }

        $this->db->bind(':id', $sub_result->id);

        try {
            $result = $this->db->single();
        } catch (PDOException $e) {
            return [
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
        $hashed_password = $result->password;


        if (password_verify($password, $hashed_password)) {
            return $result;
        } else {
            return false;
        }
    }
    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM clients WHERE email = :email
                          UNION 
                          SELECT * FROM restaurants WHERE email = :email
                          UNION 
                          SELECT * FROM drivers WHERE email = :email
                          UNION 
                          SELECT * FROM admins WHERE email = :email');
        // Bind values
        $this->db->bind(':email', $email);

        try {
            // Check row
            if ($this->db->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $e) {
            return [
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    // Get User by ID
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM clients WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        try {
            $row = $this->db->single();

            return $row;
        } catch (PDOException $e) {
            return [
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
}
