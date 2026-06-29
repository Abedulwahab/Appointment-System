<?php

session_start();

include "../db.php";

if(!isset($_SESSION['staff_id'])){

    header("Location: ../users/login.php");
    exit();
}

if(isset($_GET['approve'])){

    $id = $_GET['approve'];

    $sql = "update appointments
    set status='approved'
    where id='$id'";

    mysqli_query($conn, $sql);

    header("Location: appointments.php");
    exit();
}

if(isset($_GET['reject'])){

    $id = $_GET['reject'];

    $sql = "update appointments
    set status='rejected'
    where id='$id'";

    mysqli_query($conn, $sql);

    header("Location: appointments.php");
    exit();
}

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = "delete from appointments
    where id='$id'";

    mysqli_query($conn, $sql);

    header("Location: appointments.php");
    exit();
}

$sql = "select appointments.*, users.name, users.phone, services.service_name
from appointments
join users on appointments.user_id = users.id
join services on appointments.service_id = services.id
order by appointments.id desc";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>

<body>

<div class="table-page staff-bg">

    <div class="table-card">

        <h1>Manage Appointments</h1>

        <table>
            <tr>
                <th>Patient</th>
                <th>Phone</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['service_name']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo $row['appointment_time']; ?></td>
                <td><?php echo $row['status']; ?></td>

                <td>
                    <a class="action-btn approve"
                    href="appointments.php?approve=<?php echo $row['id']; ?>">
                    Approve
                    </a>

                    <a class="action-btn reject"
                    href="appointments.php?reject=<?php echo $row['id']; ?>">
                    Reject
                    </a>

                    <a class="action-btn delete"
onclick="return confirmDelete()"
href="appointments.php?delete=<?php echo $row['id']; ?>">
Delete
</a>
                </td>
            </tr>

            <?php } ?>

        </table>

        <a class="back-btn" href="dashboard.php">Back To Dashboard</a>

    </div>

</div>

</body>
</html>