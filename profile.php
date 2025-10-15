<?php
require 'classes/Database.php';
require 'classes/User.php';
include 'includes/header.php';

// Create a new database connection
$db = (new Database())->connect();

// Initialize the User class with the database connection
$profile = new User($db);

// Retrieve the profile data based on the ID passed in the URL
$data = $profile->getById($_GET['id']);

?>

<main id="profile-main">
    <?php if ($data): ?>
        <div class="profile-detail card">
            <!-- showing user information individually-->
            <img class="profile-image" src="<?php echo $data['image_path']; ?>" alt="Profile Image">
            <h2 class="profile-name"><?php echo htmlspecialchars($data['name']); ?></h2>
            <p class="profile-email"><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></p>
            <p class="profile-bio"><strong>Bio:</strong> <?php echo htmlspecialchars($data['bio']); ?></p>
        </div>
    <?php else: ?>
        <!-- Message shown if profile ID not found -->
        <p class="profile-error">Profile not found.</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
