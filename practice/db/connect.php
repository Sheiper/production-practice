<?php
$servername = "localhost";
$username = "root"; // замените на ваше имя пользователя
$password = ""; // замените на ваш пароль
$dbname = "practice"; // замените на имя вашей базы данных

// Создайте соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверьте соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>