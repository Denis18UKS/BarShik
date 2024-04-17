<?php
include("../connectDB.php");

if(isset($_GET['id']) && isset($_GET['status'])) {
    $tovar_id = $_GET['id'];
    $new_status = ($_GET['status'] == 'активен') ? 'неактивен' : 'активен';

    $update_query = "UPDATE products SET status = '$new_status' WHERE id = $tovar_id";
    if(mysqli_query($connect, $update_query)) {
        header("Location: admin.php"); // Перенаправление на страницу со списком тарифов
        exit();
    } else {
        echo "Ошибка изменения статуса тарифа: " . mysqli_error($connect);
    }
} else {
    echo "Некорректный запрос";
}
?>
