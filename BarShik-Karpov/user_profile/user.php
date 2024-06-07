<? session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет пользователя</title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/nav.css">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- bootstrap -->

</head>

<body>

    <?php include "../nav.php"; ?>

    <div id="edit" class="container">
        <h1>Мои данные</h1>
        <?php

        require('../connectDB.php');

        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user'];
            $sql = "SELECT * FROM users WHERE id_user = '$userId'";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc(); ?>
                <form action="update_profile.php" method="post">
                    <div id="form-contents">
                        <div class="mb-3">
                            <label for="email" class="form-label">Почта:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль:</label>
                            <input type="text" class="form-control" id="password" name="cash_password" value="<?php echo $user['cash_password']; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Сохранить изменения</button>
                </form>
        <?php
            } else {
                echo "Пользователь не найден.";
            }
        } else {
            header("Location: ../signIn.php");
            exit();
        }
        ?>
    </div>


    <div id="edit" class="container">
        <h1>Мои Заказы</h1>
        <?php
        require('../connectDB.php');

        $userId = $_SESSION['user'];
        $sql = "SELECT * FROM orders WHERE id_user = '$userId'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='addresses-table'><thead><tr><th>Адрес</th></tr></thead><tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['address']}</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>Заказов нет.</p>";
        }
        ?>
    </div>





</body>

</html>