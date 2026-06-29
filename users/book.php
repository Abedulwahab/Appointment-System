<?php

session_start();

include "../db.php";

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$services = mysqli_query($conn, "select * from services");

if(isset($_POST['book'])){

    $service_id = $_POST['service_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "insert into appointments
    (user_id, service_id, appointment_date, appointment_time, status)
    values
    ('$user_id', '$service_id', '$appointment_date', '$appointment_time', 'pending')";

    if(mysqli_query($conn, $sql)){

        $success = "Appointment request sent successfully";

    }else{

        $error = "Booking failed";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Book Appointment</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <div class="register-box">

        <h2>Book Appointment</h2>

        <?php

        if(isset($success)){
            echo "<p class='success'>$success</p>";
        }

        if(isset($error)){
            echo "<p class='error'>$error</p>";
        }

        ?>

        <form method="POST">

            <select name="service_id" required>
                <option value="">Select Service</option>

                <?php while($row = mysqli_fetch_assoc($services)){ ?>

                    <option value="<?php echo $row['id']; ?>">
                        <?php echo $row['service_name']; ?>
                    </option>

                <?php } ?>

            </select>

            <input type="date" name="appointment_date" required>

            <input type="time" name="appointment_time" required>

            <button type="submit" name="book">
                Send Request
            </button>

        </form>

        <p class="switch-page">
            <a href="dashboard.php">Back To Dashboard</a>
        </p>

    </div>

</body>

</html>