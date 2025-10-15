<?php
class User
{
    // This holds the database connection so all methods can use it
    private $pdo;

    // When we create a User object, we pass in the PDO connection
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Adds a new profile to the database
     * Takes name, email, bio, and image path as input
     */
    public function create($name, $email, $bio, $imagePath)
    {
        try {
            // Prepare an SQL query with placeholders to keep things safe
            $sql = "INSERT INTO profiles (name, email, bio, image_path) 
                    VALUES (:name, :email, :bio, :image_path)";
            $stmt = $this->pdo->prepare($sql);

            // Plug in the actual values
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':image_path', $imagePath);

            // Run the query and return true if it worked
            return $stmt->execute();

        } catch (PDOException $e) {
            // If something goes wrong, show the error
            echo "Database Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Fetches all profiles from the database
     * */
    public function getAll()
    {
        try {
            $sql = "SELECT * FROM profiles ORDER BY id DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            // Return all rows as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $this->error = "Database Read Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Gets one profile by its ID,Useful when viewing or editing a specific profile
     */
    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM profiles WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            // Bind the ID securely
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Return just one row
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $this->error = "Database Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Deletes a profile by its ID, sometime it useful
     */
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM profiles WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);

            // Run the delete query
            return $stmt->execute([$id]);

        } catch (PDOException $e) {
            $this->error = "Database Delete Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
