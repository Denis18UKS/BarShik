<?php
    session_start();

    if ($_SESSION) {
        // Проверяем, является ли пользователь админом
        $userType = "user"; // По умолчанию тип пользователя - обычный пользователь

        if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] === "admin") {
                $userType = "admin";
            } else if ($_SESSION['user_type'] === "driver"){
                $userType = "driver";
                if (isset($_POST['license'])) {
                    $license = $_POST['license'];
                    header("Location: drivers/driver.php?type=$userType&license=$license");
                }
            }
        }

        // Проверяем текущий URL на наличие параметра type
        if (!isset($_GET['type'])) {
            // Перенаправляем на index.php с соответствующим параметром
            header("Location: index.php?type=$userType");
            exit; // Обязательно завершаем выполнение скрипта после перенаправления
        }
    } else {
        // Обработка для случая, когда пользователь не авторизован
        // Вы можете добавить здесь соответствующий код, например, перенаправление на страницу входа
    }
?>
