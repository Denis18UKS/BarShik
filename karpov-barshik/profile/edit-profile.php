<?php
session_start();
require "connect.php";

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Вы не авторизованы. Пожалуйста авторизируйтесь'); location.href='/';</script>";
    exit;
}

if (isset($_POST['edit_profile'])) {
    $email = $_POST['email'];
    $phone = $_POST['cash_password'];

    $sql = "UPDATE users SET email = ?, password_hash = ? WHERE id = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $phone, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $success_message = "Профиль успешно обновлен.";
}

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Редактирование профиля</title>
</head>
<body>
    <header>
        <h1>Редактирование профиля</h1>
    </header>

    <div class="container">
        <form action="edit-profile.php" method="post">
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <div>
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div>
                <label for="phone">Телефон</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
            </div>

            <button type="submit" name="edit_profile">Сохранить изменения</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2022 Ваше название компании</p>
    </footer>
</body>
</html>