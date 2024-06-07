<?php
    include "../connectDB.php"; // Подключаемся к базе данных

    $sql = "SELECT id, name FROM users"; // запрос для выборки id и имени пользователей

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['name'] . "</option>";
        }
    }

    $connect->close();
?>
