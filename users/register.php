<?php

include "../db.php";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $check = mysqli_query($conn,
    "select * from users where email='$email'");

    if(mysqli_num_rows($check) > 0){

        $error = "Email already exists";

    }else{

        $sql = "insert into users
        (name, email, phone, password)
        values
        ('$name', '$email', '$phone', '$password')";

        if(mysqli_query($conn, $sql)){

            $success = "Account created successfully";

        }else{

            $error = "Registration failed";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>User Register</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <div class="register-box">

        <h2>Create Account</h2>

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
            placeholder="Enter Name"
            required>

            <input type="email"
            name="email"
            placeholder="Enter Email"
            required>

            <input type="text"
            name="phone"
            placeholder="Enter Phone"
            required>

            <input type="password"
            name="password"
            placeholder="Enter Password"
            required>

            <button type="submit" name="register">
                Register
            </button>

            <p class="switch-page">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </form>

    </div>

</body>

</html>