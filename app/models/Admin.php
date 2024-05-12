<?php
class admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM clients WHERE email = :email
                          UNION 
                          SELECT * FROM restaurants WHERE email = :email
                          UNION 
                          SELECT * FROM drivers WHERE email = :email');
        // Bind values
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Register Admin.
    public function register($data)
    {
        // Check account type.
        $this->db->query('INSERT INTO admins (name, email, password) VALUES(:name, :email, :password)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
