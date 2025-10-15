<?php
// Enable error reporting to help with debugging during development
// I use it inspired by yt: Program With Gio
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database and user classes
require 'classes/Database.php';
require 'classes/User.php';

// Create a database connection and initialize the User class
$db = (new Database())->connect();
$profile = new User($db);

// Retrieve and sanitize form input
$name   = htmlspecialchars($_POST['name'] ?? '');
$email  = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$bio    = htmlspecialchars($_POST['bio'] ?? '');
$image  = $_FILES['image'] ?? null;

// Validate input check if email is valid and image was uploaded successfully
if ($email && $image && $image['error'] === 0) {

    // Set the folder where images will be stored
    $targetDir = 'images/';

    // Clean the uploaded filename to avoid issues with special characters
    $filename = basename($image['name']);
    $filename = preg_replace('/[^A-Za-z0-9.\-_]/', '_', $filename);
    $targetFile = $targetDir . $filename;

    // Move the uploaded image to the target folder
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {

        // Save the profile data to the database
        $success = $profile->create($name, $email, $bio, $targetFile);

        if ($success) {
            // Redirect to success page after saving
            header('Location: success.php');
            return;
        } else {
            echo "Database error: could not save profile.";
        }

    } else {
        echo "Image upload failed. Check that the 'images' folder exists and has write permission.";
    }

} else {
    echo "Invalid input. Make sure email is valid and image is selected.";
}
?>
