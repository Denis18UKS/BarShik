<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        die("Ошибка: ID пользователя не найден в сессии.");
    }

    include "../connectDB.php";

    if ($connect->connect_error) {
        die("Ошибка подключения к базе данных: " . $connect->connect_error);
    }

    $sql_user = "SELECT * FROM users WHERE id_user = $user_id";
    $result_user = $connect->query($sql_user);

    if ($result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();
    }

    $sql_orders = "SELECT * FROM orders WHERE user_id = $user_id";
    $result_orders = $connect->query($sql_orders);

    $connect->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Личный кабинет пользователя</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/user.css'>

    <script src='js/main.js' defer></script>
    <script src='js/black-theme.js' defer></script>
</head>
<body>

<div class="container">
        <h1>Личный кабинет</h1>

        <?php if ($result_user->num_rows > 0) { ?>
            <div class="user-data">
                <!-- Форма с данными пользователя -->
            </div>
        <?php } ?>

        <div class="order-history">
            <h2>История заказов</h2>
            <ul>
                <?php
                    if ($result_orders->num_rows > 0) {
                        while ($row_order = $result_orders->fetch_assoc()) {
                            echo "<li>Заказ #" . $row_order['id_order'] . " - " . $row_order['date_order'] . "</li>";
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>