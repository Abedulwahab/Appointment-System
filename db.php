<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "appointment_system"
);

if(!$conn){
    die("connection failed");
}

?>