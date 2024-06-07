<?php
include "connectDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $email = $_POST["email"];
    if (empty($password) || empty($email)) {
        // Проверка наличия пользователя в базе данных
        $check_sql = "SELECT * FROM users WHERE email = '$email'";
        // var_dump($check_sql);
        $check_query = mysqli_query($connect, $check_sql);
        // /*
        if (mysqli_num_rows($check_query) > 0) {
            echo "<script>alert('Пользователь с таким email уже существует'); location.href = 'reg.php';</script>";
        } else {
            // Добавление пользователя в базу данных
            $sql = "INSERT INTO users (email, cash_password, bonus_balls, role, status) VALUES ('$email', '$password', 1, 'user', 'Активен')";

            if (mysqli_query($connect, $sql)) {
                echo "<script>alert('Пользователь успешно зарегистрирован.'); location.href='signIn.php'</script>";
            } else {
                echo "Ошибка: " . $sql . "<br>" . mysqli_error($connect);
            }
        }
    }
}
