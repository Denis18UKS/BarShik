<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>BarShik</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/nav.css'>

    <script src='js/main.js' defer></script>
</head>

<body>

    <?php include "nav.php" ?>






    <main>

        <div id="categories-content">
            <?php
            include "connectDB.php";
            $sql = "SELECT * FROM Categories";
            $result = $connect->query($sql);

            if ($result === false) {
                die("Ошибка выполнения запроса: " . $connect->error);
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['status'] == 'активен') {
                        echo "<button class='category-btn' data-category='" . $row['category_id'] . "'>" . $row['name_category'] . "</button>";
                    }
                }
            } else {
                echo "Категории для фильтрации не найдены";
            }

            $connect->close();
            ?>
        </div>


        <section id="tovars-contents">
            <h1 class="tovars">Напитки</h1>
            <section id="tovars" class="tovars-container">
                <?php
                include "connectDB.php";
                $sql = "SELECT * FROM products";
                $result = $connect->query($sql);
                $products = mysqli_fetch_assoc($result);
                $productId = $products['id'];

                if ($result === false) {
                    die("Ошибка выполнения запроса: " . $connect->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['status'] == 'активен') {
                            echo "<div class='product' data-category='" . $row['category_id'] . "'>";
                            echo "<img src='../tovars/" . $row['img'] . "' class='card-img-top' alt=''>";
                            echo "<div class='card-body'>";
                            echo "<h1 class='card-title'>" . $row['name'] . "</h1>";
                            echo "<p class='card-text-description' style='display: none;' id='description-" . $row['id'] . "'>" . $row['description'] . "</p>";
                            echo "<div class='price-and-btn-content'>";
                            echo "<h5>Цена: от " . $row['price'] . "₽</h5>";
                            if (isset($_SESSION['user'])) { ?>

                                <form action="add_basket.php" method="post">
                                    <input type="hidden" name="add_product" value="true">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>"> <!-- Здесь должен быть реальный ID продукта -->
                                    <button class="btn btn-primary button-tovar btn-add-cart" data-id='<?= $row['id'] ?>'>Добавить в корзину</button>
                                </form>
                <? }
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "0 результатов";
                }

                $connect->close();
                ?>
            </section>
        </section>

        <section id="info-block">
            <img src="image/Group 8197.png" alt="">

            <div id="info-text">
                <h1>Доставка напитков BarShik</h1>
                <p>Это удобный сервис, предоставляющий возможность заказывать различные напитки от известного заведения BarShik и получать их прямо у себя дома или в офисе. Благодаря многообразию предлагаемых напитков, каждый клиент может подобрать именно то, что удовлетворит его желания и вкусы. Доставка напитков от BarShik поможет вам насладиться качественными напитками без необходимости выходить из дома, сохраняя при этом высокое качество обслуживания и свежий вкус каждого напитка.</p>
            </div>
        </section>
    </main>

    <footer>
        <div id="ftr-contents">
            <div id="copyright">&copy Карпов Денис Проект BarShik 21-Веб-1</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>