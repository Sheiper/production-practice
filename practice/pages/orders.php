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
            <h3 class="text-center mt-2 mb-4">Оформленные заказы</h3>
            <?php
            session_start();

            ini_set('display_errors', 0);
            error_reporting(E_ERROR | E_WARNING | E_PARSE);

            include '../db/connect.php';

            $id_user = $_SESSION["id_user"];
            $query = 'SELECT orders.*, books.photo, books.price, books.title 
                      FROM orders 
                      JOIN books ON orders.id_book = books.id_book
                      WHERE orders.id_user = "'.mysqli_real_escape_string($conn, $id_user).'"';

            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($orders = mysqli_fetch_assoc($result)) {
                    if($orders["order_status"] == 0) {
                        $order_status = "Не получен";
                    }
                    else {
                        $order_status = "Получен";
                    }
                    $orderDate = $orders["order_date"];
                    $formattedDate = date('Y-m-d H:i', strtotime($orderDate));
                    echo '
                    <div class="d-flex justify-content-between align-items-center my-2 bg-light">
                        <div class="col-2">
                            <img src="../'.$orders["photo"].'" class="img-fluid">
                        </div>
                        <div col-4>
                            <p>Название: '.$orders["title"].'</p>
                            <p>Количество: '.$orders["count"].'</p>
                            <p>Цена: '.$orders["price"].'р</p>
                        </div>
                        <div>
                            <p>Дата заказа: '.$formattedDate.'</p>
                            <p>Дата получения: '.$orders["date_of_receipt"].'</p>
                            <p>Статус заказа: '.$order_status.'</p>
                        </div>
                    </div>';
                }
            } 
            else {
                echo "err(: " . mysqli_error($conn);
            }
        
            mysqli_close($conn);
            ?>
        </div>
    </body>
</html>