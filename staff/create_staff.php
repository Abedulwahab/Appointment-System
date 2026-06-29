<?php

session_start();

include "../db.php";

if(!isset($_SESSION['staff_id'])){

    header("Location: ../users/login.php");
    exit();
}

if(isset($_POST['create'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $check = mysqli_query($conn,
    "select * from staff where email='$email'");

    if(mysqli_num_rows($check) > 0){

        $error = "Email already exists";

    }else{

        $sql = "insert into staff
        (name, email, password, role)

        values

        ('$name','$email','$password','$role')";

        if(mysqli_query($conn, $sql)){

            $success = "Staff account created successfully";

        }else{

            $error = "Creation failed";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Create Staff</title>

    <link rel="stylesheet"
    href="../css/style.css">

</head>

<body>

<div class="home-page staff-bg">

    <div class="register-box">

        <h2>Create Staff Account</h2>

        <?php

        if(isset($success)){
            echo "<p class='success'>$success</p>";
        }

        if(isset($error)){
            echo "<p class='error'>$error</p>";
        }

        ?>

        <form method="POST">

            <input type="text"
            name="name"
            placeholder="Enter Staff Name"
            required>

            <input type="email"
            name="email"
            placeholder="Enter Email"
            required>

            <input type="password"
            name="password"
            placeholder="Enter Password"
            required>

            <select name="role" required>

                <option value="">Select Role</option>

                <option value="admin">
                    Admin
                </option>

                <option value="employee">
                    Employee
                </option>

            </select>

            <button type="submit"
            name="create">

            Create Account

            </button>

        </form>

        <p class="switch-page">

            <a href="dashboard.php">

            Back To Dashboard

            </a>

        </p>

    </div>

</div>

</body>
</html>