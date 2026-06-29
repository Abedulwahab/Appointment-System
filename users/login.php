<?php

session_start();

include "../db.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // first check staff
    $staff_sql = "select * from staff
    where email='$email'
    and password='$password'";

    $staff_result = mysqli_query($conn, $staff_sql);

    if(mysqli_num_rows($staff_result) > 0){

        $staff = mysqli_fetch_assoc($staff_result);

        $_SESSION['staff_id'] = $staff['id'];
        $_SESSION['staff_name'] = $staff['name'];
        $_SESSION['staff_role'] = $staff['role'];

        header("Location: ../staff/dashboard.php");
        exit();

    }

    // then check users
    $user_sql = "select * from users
    where email='$email'
    and password='$password'";

    $user_result = mysqli_query($conn, $user_sql);

    if(mysqli_num_rows($user_result) > 0){

        $user = mysqli_fetch_assoc($user_result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: dashboard.php");
        exit();

    }else{

        $error = "Invalid Email Or Password";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet"
    href="../css/style.css">

</head>

<body>

    <div class="register-box">

        <h2>Login</h2>

        <?php

        if(isset($error)){

            echo "<p class='error'>$error</p>";
        }

        ?>

        <form method="POST">

            <input type="email"
            name="email"
            placeholder="Enter Email"
            required>

            <input type="password"
            name="password"
            placeholder="Enter Password"
            required>

            <button type="submit"
            name="login">

            Login

            </button>

            <p class="switch-page">

            Don't have an account?

            <a href="register.php">Register</a>

            </p>

        </form>

    </div>

</body>

</html>