<?php

session_start();

if(!isset($_SESSION['staff_id'])){

    header("Location: ../users/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Home</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="home-page staff-bg">

    <div class="home-card">

        <h1>Staff Dashboard</h1>

        <p class="home-text">
            Welcome, <?php echo $_SESSION['staff_name']; ?>. Manage appointment requests and staff accounts.
        </p>

        <div class="home-actions">

            <a class="home-btn" href="appointments.php">
                Manage Appointments
            </a>

            <a class="home-btn second" href="create_staff.php">
                Create Staff Account
            </a>

            <a class="home-btn danger" href="../users/logout.php">
                Logout
            </a>

        </div>

    </div>

</div>

</body>
</html>