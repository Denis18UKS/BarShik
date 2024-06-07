<?php
session_start();
require "connectDB.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Проверяем, заполнены ли все поля
if (empty($email) || empty($password)) {
    echo "<script>alert('Заполните все поля!'); location.href='../signIn.php';</script>";
} else {
    // Проверяем существование пользователя с таким логином и паролем в таблице "users"
    $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `cash_password` = '$password'";
    $result = mysqli_query($connect, $sql);

    // Проверяем количество строк, возвращенных из запроса
    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);
        $role = $res['role'];

        if ($role == 'admin') {
            $_SESSION['admin'] = $res['id_user'];
            echo "<script>alert('Вы вошли как администратор'); location.href='../';</script>";
        } else {
            $_SESSION['user'] = $res['id_user'];
            echo "<script>alert('Вы вошли как пользователь'); location.href='../';</script>";
        }
    }
}
