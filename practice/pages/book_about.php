<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Сайт на практику</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../mycss/main.css">
    </head>
    <body style="background-color: rgb(235,235,235)">
        <header style="background-color: rgb(255,255,255)" class="shadow">
            <nav class="d-flex justify-content-between">
                <div class="d-flex justify-content-start align-items-center">
                    <h2>
                        <a class="text-decoration-none text-dark" href="../index.php">Магазин книг</a>
                    </h2>
                </div>
            </nav>
        </header>
        <div style="background-color: rgb(255,255,255)" class="container col-12 rounded my-5 border shadow">
            <h3 class="text-center mt-2 mb-4">Добавить в корзину</h3>
            <div class="container d-flex justify-content-between py-2">
                <?php
                ini_set('display_errors', 0);
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                include '../db/connect.php';

                $id = $_GET["id"];
                $query = 'SELECT * FROM books WHERE id_book="'.$id.'"';
                $result = mysqli_query($conn, $query);
                $user = mysqli_fetch_assoc($result);

                echo '
                <div class="col-4">
                    <img src="../'.$user["photo"].'" class="img-fluid">
                </div>
                <div class="col-8 mx-4">
                    <p class="fw-bold fs-5">Название: '.$user["title"].'</p>
                    <p class="fw-bold fs-5">Автор: '.$user["author"].'</p>
                    <p class="fw-bold fs-5">Жанр: '.$user["genre"].'</p>
                    <p class="fw-bold fs-5">Описание</p>
                    <p>'.$user["descriptions"].'</p>
                    <p class="fw-bold fs-5">Цена: '.$user["price"].'р</p>
                    <form action="../php/to_cart.php" method="POST">
                        <h5 class="fw-bold">Количество</h5>
                        <input type="number" name="count" value="1" max="10" min="1" class="my-2">
                        <input type="hidden" value="'.$id.'" name="id_book">
                        <button class="btn bg-success text-light" type="submit">Добавить</button>
                        <a href="../index.php" class="btn bg-danger text-light">Назад</a>
                    </form>';
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </body>
</html>