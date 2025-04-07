<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../db/connect.php';


if (!isset($_SESSION["id_user"])) {
    header("Location: ../pages/login.html");
}
else {
    $id_user = $_SESSION["id_user"];

    $id_book = $_POST["id_book"];

    $count = $_POST["count"];


    $stmt = $conn->prepare("INSERT INTO `carts` (`id_user`, `id_book`, `count`) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $id_user, $id_book, $count);

    if ($stmt->execute()) {
        echo "ok )";
        header("Location: ../index.php");
    } 
    else {
    echo "not ok (";
    }
    mysqli_close($conn);
}
