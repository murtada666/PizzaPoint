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


    public function registerAccount($table_name, $data)
    {
        // Table name is dynamic.
        $this->db->query("INSERT INTO " . $table_name . " (name, email, password) VALUES(:name, :email, :password)");

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
