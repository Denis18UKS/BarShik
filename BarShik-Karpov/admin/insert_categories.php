<?php
// Подключение к базе данных
    include "../connectDB.php";
// Проверка подключения
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Получение остальных данных из формы
$name_category = $_POST["name_category"];

// Вставка данных в базу данных
$sql = "INSERT INTO categories (name_category, status) VALUES ('$name_category', 'активен')";

if ($connect->query($sql) === TRUE) {
    // Успешно добавлено
    echo "<script>location.href='admin.php'; alert('Новая категория успешно добавлена!');</script>";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();
?>