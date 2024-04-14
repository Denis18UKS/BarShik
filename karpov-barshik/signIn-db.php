<?php  
require "connect.php";  

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $email = $_POST["email"];  
    $password = $_POST["cash_password"];

    // Хэшируем введенный пароль для сравнения с захешированным паролем в базе данных
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $result = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
    
    if ($result && mysqli_num_rows($result) > 0) {  
        $user = mysqli_fetch_assoc($result); 
        if(password_verify($password, $user['password_hash'])){ 
            if($user['status'] == 'заблокирован'){ 
                echo "<script>alert('Доступ запрещен. Вы заблокированы.');</script>"; 
            } else { 
                session_start(); // Начинаем сессию

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $email;
                $_SESSION['cash_password'] = $password;

                // После установки сессии редирект на user.php
                header("Location: profile/user.php");
                exit();  
            } 
        } else {
            echo "<script>alert('Неверный пароль!'); location.href='/'; </script>";  
        }
    } else {  
        echo "<p class='error'></p>";  
        echo "<script>alert('Пользователь с таким email не найден.'); location.href='/'; </script>";  
    }  
}
?>