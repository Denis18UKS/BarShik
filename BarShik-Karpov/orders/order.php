<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Заказать поездку</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/order.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/back.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/taxi.css'>

    <script src="../js/order.js"></script>
    <script src='../js/black-theme.js' defer></script>

</head>
<body>

<?php include "../taxi-squares.html" ?>

<a href="/"><img src="../image/home-black.png" alt="back" title="Главная" id="back"></a>

    <h2>Заказать поездку</h2>
    <form method="post" action="process_order.php">
        
        <label for="user">Пользователь</label>

        <select name="user_id" id="user_id">
            <?php include "option-select.php"?>
        </select>


        <label for="point_a">Пункт отправления:</label>
        <input type="text" id="point_a" name="point_a" required>
        
        <label for="point_b">Пункт назначения:</label>
        <input type="text" id="point_b" name="point_b" required>

        <label for="date">Дата поездки:</label>
        <input type="date" id="date" name="date" required>

        <label for="tovarf">Выберите тариф:</label>
        <select id="tovarf" name="tovarf" onchange="showFormFields()">
            <?php
            include "../connectDB.php";

            $sql = "SELECT * FROM products"; // Замените на свой запрос для выборки тарифов из базы данных

            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['title_tovar'] . "</option>";
                }
            }

            $connect->close();
            ?>
        </select>

        <div id="extraFields" style="display:none;"></div>

        <input type="submit" value="Отправить заказ">
    </form>
</body>
</html>