<?php

include '../db/connect.php';

$id_cart = $_POST["id_cart"];

$query = 'DELETE FROM carts WHERE id_cart = '.$id_cart.'';


$result = mysqli_query($conn, $query);

if ($result) {
    echo "deleted )";
    header("Location: ../pages/cart.php");
}
else {
    echo "not delete (";
}
mysqli_close($conn);