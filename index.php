<?php include 'includes/header.php'; ?>
<main>
    <h2>Create Your Profile</h2>
    <!--user input part-->
    <form action="submit.php" method="POST" enctype="multipart/form-data">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Bio</label>
        <textarea name="bio"></textarea>

        <label>Profile Image</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">Submit</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
