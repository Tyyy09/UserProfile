CREATE TABLE profiles (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(100) NOT NULL,
                          email VARCHAR(100) NOT NULL,
                          bio TEXT,
                          image_path VARCHAR(255) NOT NULL
);
