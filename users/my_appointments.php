<?php

session_start();

include "../db.php";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "select appointments.*, services.service_name
from appointments
join services on appointments.service_id = services.id
where appointments.user_id = '$user_id'
order by appointments.id desc";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Appointments</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="table-page">

    <div class="table-card">

        <h1>My Appointments</h1>

        <table>
            <tr>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <tr>
                <td><?php echo $row['service_name']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo $row['appointment_time']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>

            <?php } ?>

        </table>

        <a class="back-btn" href="dashboard.php">Back To Dashboard</a>

    </div>

</div>

</body>
</html>