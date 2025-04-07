<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db/connect.php';

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$birthday = $_POST['birthday'];
$email = $_POST['email'];
$pass = $_POST['password'];
$role = $_POST['role'];
$password = password_hash($pass,PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO `users` (`last_name`, `first_name`, `middle_name`, `birthday`, `email`, `password`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $lastname, $firstname, $middlename, $birthday, $email, $password, $role);

if ($stmt->execute()) {
    echo "you are registred.";
    header("Location: ../index.php");
} 
else {
    echo "can't register you.";
}

$stmt->close();