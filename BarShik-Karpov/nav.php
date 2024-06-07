<? session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='/design/css/nav.css'>

    <script src='/design/js/main.js'></script>
</head>

<body>


    <nav>
        <div class="Logo-content">
            <h1 class="logo-text">BarShik</h1>
        </div>

        <ul class="nav-list">
            <?php

            if ($_SESSION) {
                if (isset($_SESSION['admin'])) { ?>
                    <li><a href="admin/admin.php">Управление</a></li>
                    <li><a href="../map.php">Карта</a></li>
                    <li><a href="../#tarifs-contents">Тарифы</a></li>
                <?
                } else { ?>
                    <li><a href="../">Главная</a></li>
                    <li><a href='user_profile/user.php'>Личный кабинет</a></li>
                    <li><a href="../#tovars-contents">Напитки</a></li>
                <? } ?>

            <? } else { ?>
                <li><a href='../reg.php'>Регистрация</a></li>
                <li><a href="../#tovars">Напитки</a></li>
                <li><a href="../signIn.php">Вход</a></li>
            <? }
            ?>
        </ul>

        <ul class="nav-list">
            <?php
            if ($_SESSION) {
                if (isset($_SESSION['admin'])) {
                    echo '<li><a href="../exit.php">Выйти</a></li>';
                } else {
                    echo '<li><a href="../cart.php">Корзинв</a></li>';
                    echo '<li><a href="../orders/orders.php">Оформить заказ</a></li>';
                    echo '<li><a href="../exit.php">Выйти</a></li>';
                }
            }
            ?>
        </ul>
    </nav>

</body>

</html>