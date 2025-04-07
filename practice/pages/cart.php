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
            <h3 class="text-center mt-2 mb-4">Корзина</h3>
            <?php
            session_start();

            ini_set('display_errors', 0);
            error_reporting(E_ERROR | E_WARNING | E_PARSE);

            include '../db/connect.php';

            $id_user = $_SESSION["id_user"];
            $query = 'SELECT carts.*, books.photo, books.price, books.title 
                      FROM carts
                      JOIN books ON carts.id_book = books.id_book 
                      WHERE carts.id_user = "'.mysqli_real_escape_string($conn, $id_user).'"';

            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($cart = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="d-flex justify-content-between align-items-center my-2 bg-light">
                        <div class="col-2">
                            <img src="../'.$cart["photo"].'" class="img-fluid">
                        </div>
                        <div class="col-4">
                            <p>Название: '.$cart["title"].'</p>
                            <p>Количество: '.$cart["count"].'</p>
                            <p>Цена: '.$cart["price"].'р</p>
                        </div>
                        <form method="POST" action="../php/del_cart.php">
                            <input type="hidden" name="id_cart" value="'.$cart["id_cart"].'">
                            <button type="submit" class="btn btn-sm bg-danger mx-1 my-1 text-light">Удалить</button>
                        </form>
                    </div>';
                }
            } 
            else {
                echo "err(: " . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>
            <div class="d-flex justify-content-end align-items-center my-2 bg-light">
                <form action="../php/to_order.php" method="POST">
                    <button type="submit" class="btn bg-success mx-1 my-1 text-light">Заказать</button>
                </form>
            </div>
        </div>
    </body>
</html>