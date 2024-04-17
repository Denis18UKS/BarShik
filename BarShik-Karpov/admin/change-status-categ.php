<?php
include("../connectDB.php");

// Проверяем существование и передачу данных через GET-запрос
if(isset($_GET['category_id']) && isset($_GET['status'])) {
    $cat_id = $_GET['category_id'];
    $new_status = ($_GET['status'] == 'активен') ? 'неактивен' : 'активен';

    $update_query = "UPDATE categories SET status = '$new_status' WHERE category_id = $cat_id";
    var_dump($update_query);
    
    if(mysqli_query($connect, $update_query)) {
        header("Location: admin.php"); // Редирект на страницу администратора
        exit();
    } else {
        echo "Ошибка изменения статуса категории: " . mysqli_error($connect);
    }
} else {
    echo "Некорректный запрос: отсутствуют category_id или status в GET-параметрах";
}
?>
