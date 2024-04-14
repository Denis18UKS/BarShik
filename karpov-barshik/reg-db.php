<?php 
include "connect.php";

session_start(); // Начинаем сессию

$email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES);
$password = htmlspecialchars(trim($_POST['cash_password']), ENT_QUOTES); 

if(mb_strlen($password) < 5 || mb_strlen($password) > 100){
    echo "<script>alert('Недопустимая длина пароля'); location.href='/';</script>";
    exit();
}

$result = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
$user_email = mysqli_fetch_assoc($result);

if(!empty($user_email)){
    echo "<script>alert('Данная почта уже используется!'); location.href='/';</script>";
    exit();
}

$insert = mysqli_query($connect, "INSERT INTO users (email, password_hash, Bonus_points, role) VALUES ('$email', '$password', '1', 'user')");

if($insert) {
    $user_id = mysqli_insert_id($connect);
    
    $_SESSION['user_id'] = $user_id;
    
    header("Location: /");
    exit();
} else {
    echo "<script>alert('Возникла проблема при регистрации. Пожалуйста, попробуйте снова.'); location.href='/';</script>";
}
?>
