<?php
// Подключение к базе данных
    include "../connectDB.php";
// Проверка подключения
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Обработка загруженного файла
$target_dir = "../tovars/"; // Путь к папке для загрузки
$target_file = $target_dir . basename($_FILES["img"]["name"]);
move_uploaded_file($_FILES["img"]["tmp_name"], $target_file); // Перемещение файла

// Получение остальных данных из формы
$name = $_POST["name"];
$description = $_POST["description"];
$category_id = $_POST["cat_id"];
$price = $_POST["price"];

// Вставка данных в базу данных
// $sql = "INSERT INTO products (name, description, price, img, ) VALUES ('$target_file', '$title', '$description', '$price', 'активен')";
$sql = "INSERT INTO products (name, description, category_id ,price, img, status) VALUES ('$name', '$description', '$category_id', '$price', '$target_file' ,'активен')";


if ($connect->query($sql) === TRUE) {
    // Успешно добавлено
    echo "<script>location.href='admin.php'; alert('Новый товар успешно добавлен!');</script>";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();
?>