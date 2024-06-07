<?php

include "../connectDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $userId = $_POST['user_id'];
    $point_A = $_POST['point_a'];
    $point_B = $_POST['point_b'];
    $date = $_POST['date'];
    $tovarf = $_POST['tovarf'];

    // Получение id водителя из другой таблицы (предположим, что таблица с водителями называется "drivers")
    $driverSql = "SELECT id FROM drivers LIMIT 1";
    $driverResult = $connect->query($driverSql);
    $driverRow = $driverResult->fetch_assoc();
    $driverId = $driverRow['id'];

    // Добавление заказа в таблицу orders
    $sql = "INSERT INTO orders (id_user, id_drivers, id_tovars, point_A, point_B, `order-travel`, status) 
            VALUES ('$userId', '$driverId', '$tovarf', '$point_A', '$point_B', '$date', 'новый')";

    if ($connect->query($sql) === TRUE) {
        echo "<script>alert('Заказ успешно добавлен!'); location.href='order-history.php'</script>";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $connect->error;
    }

    $connect->close();
} else {
    echo "Ошибка: Неверный метод запроса.";
}
?>