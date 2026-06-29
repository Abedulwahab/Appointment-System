<?php

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Home</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="home-page">

    <div class="home-card">

        <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>

        <p class="home-text">
            From here you can book a new appointment and check the status of your requests.
        </p>

        <div class="home-actions">

            <a class="home-btn" href="book.php">
                Book Appointment
            </a>

            <a class="home-btn second" href="my_appointments.php">
                My Appointments
            </a>

            <a class="home-btn danger" href="logout.php">
                Logout
            </a>

        </div>

    </div>

</div>

</body>
</html>