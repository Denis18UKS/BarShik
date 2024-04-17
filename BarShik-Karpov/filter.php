<?php
    include "connectDB.php";

    if(isset($_POST['category'])) {
        $cat_filter = $_POST['category'];
        $sql = "SELECT * FROM products WHERE category_id = '$cat_filter' AND status = 'активен'";
        $result = $connect->query($sql);

        if ($result === false) {
            die("Ошибка выполнения запроса: " . $connect->error);
        }

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div id='tovar-card' style='width: 20rem;'>";
                echo "<img src='../tovars/" . $row['img'] . "' class='card-img-top' alt=''>";
                echo "<div class='card-body'>";
                echo "<h1 class='card-title'>" . $row['name'] . "</h1>";
                echo "<p class='card-text-description' style='display: none;' id='description-" . $row['id'] . "'>" . $row['description'] . "</p>";
                echo "<div class='price-and-btn-content'>";
                echo "<h5>Цена: от " . $row['price'] . "₽</h5>";
                echo "<button class='btn btn-primary button-more' data-id='" . $row['id'] . "'>Читать подробнее</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "0 результатов";
        }

        $connect->close();
    } else {
        echo "Категория не выбрана";
    }
?>