<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}



require('../connectDB.php');

if (isset($_SESSION['user']) && isset($_POST['email'], $_POST['cash_password'])) {

    $email = $_POST['email'];
    $password = $_POST['cash_password']; // Хеширование пароля
    $userId = $_SESSION['user'];

    $sql = "UPDATE users SET email = '$email', cash_password = '$password' WHERE id_user = '$userId'";

    if ($connect->query($sql) === TRUE) {
        echo "<script>alert('Данные обновлены успешно!');location.href='user.php';</script>";
        exit();
    } else {
        echo "Ошибка: " . $connect->error;
    }
} else {
    echo "Ошибка: данные не получены.";
}

$connect->close();
