<?php
session_start();

// Получаем данные из формы
$email = strip_tags(trim($_POST['email']));
$pass = strip_tags(trim($_POST['password']));

if (empty($email) || empty($pass)) {
    echo "<script>alert('Заполните все поля'); location.href='../signin.php';</script>";
} else {
    // Подключение к базе данных
    $con = mysqli_connect("localhost", "root", "", "BarShik");

    // Экранируем входные данные
    $escapedEmail = mysqli_real_escape_string($con, $email);
    $escapedPass = mysqli_real_escape_string($con, $pass);

    // Формируем SQL-запрос с экранированными данными
    $query = "SELECT * FROM users WHERE email='$escapedEmail' AND cash_password='$escapedPass'";

    // Выполняем запрос
    $result = mysqli_query($con, $query);

    $res = mysqli_fetch_assoc($result);

    // Проверка наличия пользователя
    if ($res === NULL) {
        echo "<script>alert('Такой пользователь не найден.'); location.href='../signin.php';</script>";
        exit();
    } else {
        // Установка сессии в зависимости от роли пользователя
        if ($res['role'] == 'user') {
            $_SESSION["user_id"] = $res["id_user"];
            $_SESSION["user_email"] = $res["email"];
            echo "<script>alert('Вы вошли как пользователь'); location.href='../user_profile/user.php';</script>";
        } else if ($res['role'] == 'admin') {
            $_SESSION["admin"] = $res["id_user"];
            echo "<script>alert('Вы вошли как администратор'); location.href='../admin.php';</script>";
        }
    }

    // Закрытие соединения
    mysqli_close($con);
}
