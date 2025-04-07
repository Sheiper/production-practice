<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db/connect.php';

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$query = 'SELECT * FROM users WHERE email = ?';
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['role'] = $user['role'];
        $_SESSION['id_user'] = $user['id_user'];
        header("Location: ../index.php");
    } 
    else {
        echo "Error: incorrect password";
    }
} 
else {
    echo "Error: user is not user";
}

mysqli_close($conn);
