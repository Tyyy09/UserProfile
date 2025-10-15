<?php
/*
 * I used two separate classes to organize my code more effectively:
 * 1. Database.php This class handles the PDO database connection. It centralizes the connection logic so it can be reused across different parts of the application.
 * 2. User.php This class contains all user-related operations, such as creating, reading, or retrieving user profiles. It depends on the Database class for access to the database.
 */
class Database {
    private $host = '172.31.22.43';
    private $db = 'Ichty200626964';
    private $user = 'Ichty200626964';
    private $pass = 'FL9Lv6mKbN';
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Unfortunately, The Connection failed: " . $e->getMessage());
        }
    }
}
?>
