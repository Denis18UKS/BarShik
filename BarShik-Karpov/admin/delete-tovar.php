<?php
    include "../connectDB.php";

    if(isset($_GET['id'])) {
        $id_tovar = $_GET['id'];
        
        $sql = "DELETE FROM tovars WHERE id = $id_tovar";
        $result = mysqli_query($connect, $sql);

        if($result) {
            echo "<script>alert('Тариф успешно удален!'); location.href='admin.php';</script>";
        } else {
            echo "Ошибка при удалении тарифа";
        }
    } else {
        echo "Не удалось получить идентификатор тарифа для удаления";
    }

    mysqli_close($connect);
?>