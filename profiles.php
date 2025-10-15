<?php
// Load database and user classes
require 'classes/Database.php';
require 'classes/User.php';

// Include the header layout
include 'includes/header.php';

// Connect to the database and fetch all user profiles
$db = (new Database())->connect();
$profile = new User($db);
$profiles = $profile->getAll();
?>

<main>
    <h2>User Profiles</h2>

    <?php if (!empty($profiles)): ?>
        <div class="profile-list">
            <?php foreach ($profiles as $p): ?>
                <div class="profile-card">
                    <!-- Link to individual profile page using the user's ID -->
                    <a href="profile.php?id=<?php echo $p['id']; ?>" aria-label="View profile of <?php echo htmlspecialchars($p['name']); ?>">
                        <!-- Display the user's profile image -->
                        <img src="<?php echo htmlspecialchars($p['image_path']); ?>" alt="Profile image of <?php echo htmlspecialchars($p['name']); ?>">
                        <!-- Display the user's name -->
                        <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Message shown if no profiles are found -->
        <p>No profiles found. <a href="index.php">Create new</a>!</p>
    <?php endif; ?>
</main>
<?php
// Include the footer layout
include 'includes/footer.php';
?>
