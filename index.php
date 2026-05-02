<?php
require_once 'config/config.php';
require_once 'helpers/functions.php';

$pageTitle = 'RedPulse - Blood Donation Network';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo "<title>$pageTitle</title>"; ?>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require_once 'views/navigation.php'; ?>

    <div class="toast" id="toast"></div>

    <?php require_once 'views/home.php'; ?>
    <?php require_once 'views/donate.php'; ?>
    <?php require_once 'views/donors.php'; ?>
    <?php require_once 'views/admin.php'; ?>

    <script>
        // Clear old data for fresh start
        if (localStorage.getItem('rp_donors') === '[]') {
            localStorage.removeItem('rp_donors');
        }
    </script>
    <script src="assets/js/app.js"></script>
</body>
</html>