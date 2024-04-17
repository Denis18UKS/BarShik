<?php  
include "connectDB.php";  

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $email = $_POST["email"];  
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email' AND cash_password = '$password'";   

    $result = mysqli_query($connect, $sql);  

    if ($result) {
        if (mysqli_num_rows($result) > 0) {  
            $user = mysqli_fetch_assoc($result); 
            if($user['status'] == 'заблокирован'){ 
                echo "<script>alert('Доступ запрещен. Вы заблокированы. Обратитесь в поддержку'); location.href='signIn.php'</script>"; 
            } else {
                if($user['role'] === 'admin') {
                    // Авторизация как администратор
                    session_start();  
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_role'] = 'admin';

                    header("Location: /admin/admin.php"); // Перенаправление на админ панель
                    exit();
                } else {
                    // Авторизация как обычный пользователь
                    session_start();  
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $email;

                    header("Location: /"); // Перенаправление на главную страницу или личный кабинет  
                    exit();
                }
            }
        } else {
            echo "<p class='error'></p>";  
            echo "<script>alert('Неверный email или пароль!'); location.href='signIn.php';</script>";  
        }  
    } else {
        // Обработка ошибки запроса к базе данных
        echo "Ошибка выполнения запроса: " . mysqli_error($connect);
    }
}  
?>
