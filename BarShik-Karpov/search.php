<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Результаты поиска файлов</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/search.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/back.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="js/black-theme.js" defer></script>
</head>
<body style="background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(24,83,93,1) 17%, rgba(47,170,153,1) 100%);">
    
    <a href="/"><img src="image/barshik-icon.png" alt="back" title="Главная" id="back"></a>
    <h1>Результаты поиска</h1>

    <section id="search-contents">
            <?php
                include "connectDB.php";
                if(isset($_POST['search'])) {
                    $search_query = $_POST['search']; // Получаем значение запроса поиска
                    // Выполняем поиск файлов в двух таблицах базы данных
                    $sql = "SELECT * FROM products WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
                    $result = $connect->query($sql);

                    if ($result !== false && $result->num_rows > 0) {
                        // Выводим найденные файлы
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='tovar'>";
                            echo "<h2>".$row['name']."</h2>";
                            echo "<p>".$row['description']."</p>";
                            // echo "<a href='/?id=" . $row['id'] . "'><button class='btn btn-primary'>Перейти</button></a>";
                            echo "<a href='/#tovars'><button class='btn-search'>Перейти</button></a>";
                            echo "</div>";
                        }
                    } else {
                        echo "Ничего не найдено";
                    }
                }
            ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>

<style>
    *{
        color: white;
    }
</style>