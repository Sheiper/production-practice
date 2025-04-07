<?php
include '../db/connect.php';

$name = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];

if (getimagesize($tmp_name)) {
  $photo_url = 'img/books_photo/'.$name;

  move_uploaded_file($tmp_name, '../img/books_photo/'.$name);

  $price = $_POST['price'];
  $title = $_POST['title'];
  $author = $_POST['author'];
  $genre = $_POST['genre'];
  $descriptions = $_POST['descriptions'];


  $query="INSERT INTO books (photo,	price,	title, author, genre, descriptions) VALUES ('$photo_url', '$price', '$title', '$author', '$genre', '$descriptions')";
  $result=mysqli_query($conn, $query);
    if ($result){
      mysqli_close($conn);
      header("Location: ../index.php");
    }
    else {
      echo "Error";
    }
  }
else {
  echo "Произошла ошибка, поле обложка содержит недопустимый формат, используйте jpeg или png";
}