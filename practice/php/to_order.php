<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../db/connect.php';

$id_user = $_SESSION["id_user"];

$query = 'SELECT carts.* 
          FROM carts
          JOIN books ON carts.id_book = books.id_book 
          WHERE carts.id_user = ?';

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

$order_date = date("Y-m-d H:i:s",strtotime("+6 hours"));
$date_of_receipt = date("Y-m-d", strtotime("+7 days"));
$order_status = false;

if ($result && $result->num_rows > 0) {
    $success = true;

    while ($cart = $result->fetch_assoc()) {
        $insert_stmt = $conn->prepare("INSERT INTO `orders` (`order_date`, `date_of_receipt`, `order_status`, `id_user`, `id_book`, `count`) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_stmt->bind_param("ssiiii", $order_date, $date_of_receipt, $order_status, $id_user, $cart["id_book"], $cart["count"]);
        
        if (!$insert_stmt->execute()) {
            $success = false;
            break;
        }
    }

    if ($success) {
        $delete_stmt = $conn->prepare("DELETE FROM carts WHERE id_user = ?");
        $delete_stmt->bind_param("i", $id_user);
        $delete_stmt->execute();

        echo "Заказы успешно созданы и корзина очищена!";
        header("Location: ../pages/orders.php");
    } else {
        echo "Ошибка при вставке заказа: " . $insert_stmt->error;
    }
} else {
    echo "Корзина пуста или возникла ошибка: " . mysqli_error($conn);
}

mysqli_close($conn);
