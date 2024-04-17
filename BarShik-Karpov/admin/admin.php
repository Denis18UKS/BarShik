<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="/js/admin_panel.js" defer></script>
    <script src="/js/save-choose.js" defer></script>
    <script src='/js/black-theme.js' defer></script>

    <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- bootstrap -->

</head>
<body>
    <div class="sidebar">
        <a href="admin.php" id="add-met-link">Управление товарами</a>
        <a href="control-users.php" id="add-programs-link">Управление пользователями</a>
        <a href="../exit.php" id="logout-link">Выйти</a>
    </div>

    <div class="content" id="content-tovarfs">
        <!-- Контент для управления товарами -->
        <h2>Управление товарами</h2>
        


    <div id="btns-contents">
            <!-- Модальное окно для добавления товара -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить товар
        </button>

            <!-- Модальное окно для добавления категории -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoriesModal">
            Добавить категорию
        </button>

    </div>

    <!-- Модальное окно для добавления товара -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление тарифа</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                    <h2>Добавить новый товар</h2>
                        <form id="tovar-form" action="insert_tovar.php" method="post" enctype="multipart/form-data" >

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Название" required minlength="5" maxlength="20"><br>
                            <label for="title">Название:</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea id="description" class="form-control" id="floatingInput" name="description" placeholder="Описание"  rows="4" required minlength="5" maxlength="500"></textarea><br>
                            <label for="description">Описание:</label>
                        </div>

                        <!-- сделай select через php -->
                        <div class="form-floating mb-3">
                                <?php 
                                    include "../connectDB.php";

                                    if($connect -> connect_error){
                                        die ("Ошибка соединения: " . $connect->connect_error);
                                    }

                                    $sql = "SELECT * FROM Categories WHERE status = 'активен'";
                                    $result = mysqli_query($connect, $sql);

                                    echo "<select name = 'cat_id' id = 'cat_id'>";
                                    if($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value = '" . $row['category_id'] . "'>" . $row['name_category'] . "</option>";
                                        }
                                    }
                                    echo "</select>";

                                    $connect->close();
                                ?>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="Цена" name="price" required min="300" max="1500"><br>
                            <label for="price">Цена:</label>
                        </div>

                    <div class="form mb-3">
                        <label for="img">Изображение:</label>
                        <input type="file" id="img" name="img" accept="image/*" required><br>
                    </div>




                            <button type="submit" class="btn-submit-add-tovar">Добавить товар</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для добавления категории -->
    <div class="modal fade" id="categoriesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление категории</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                    <h2>Добавить категорию</h2>
                    <form id="tovar-form" action="insert_categories.php" method="post" enctype="multipart/form-data" >

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Цена" name="name_category" required min="300" max="1500"><br>
                            <label for="text">Имя категории :</label>
                        </div>
                            <button type="submit" class="btn-submit-add-tovar">Добавить категорию</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- отдохни, но не забудь что тебе ещё нужно сделать поиск и фильтрацию товаров в админке -->

<div id="categories-content">
    <?php
        include "../connectDB.php";
        $sql = "SELECT * FROM Categories";
        $result = $connect->query($sql);

        if ($result === false) {
            die("Ошибка выполнения запроса: " . $connect->error);
        }

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
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

<section id="tovars-control">

        <table>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Стоимость</th>
                <th>Картинка</th>
                <th>Статус</th>
                <th>Действие</th>
                <th>Действие</th>
            </tr>
            <?php
                include("../connectDB.php");

                $tovar_control = "SELECT * FROM products";
                $tovar_result = mysqli_query($connect, $tovar_control);

                if (mysqli_num_rows($tovar_result) > 0) {
                    while ($tovar = mysqli_fetch_assoc($tovar_result)) {
                        echo "<tr>";
                        echo "<td>" . $tovar['id'] . "</td>";
                        echo "<td>" . $tovar['name'] . "</td>";
                        echo "<td>" . $tovar['description'] . "</td>";
                        echo "<td>" . $tovar['price'] . "₽" . "</td>";
                        echo "<td>" . $tovar['img'] . "</td>";
                        echo "<td>" . $tovar['status'] . "</td>";
                        if ($tovar['status'] == 'активен') {
                            echo "<td><a href='change-status-tovar.php?id=" . $tovar['id'] . "&status=активен' onclick='confirmRemove()' class='remove'>Удалить</a></td>";
                        } else {
                            echo "<td><a href='change-status-tovar.php?id=" . $tovar['id'] . "&status=неактивен' onclick='confirmRestore()' class='restore'>Восстановить</a></td>";
                        } ?>

                        <td><a href='delete-tovar.php?id=<?php echo $tovar['id']; ?>' onclick='return confirmDelete()' class='delete'>Уничтожить</a></td>

                        <?php echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Нет продуктов для отображения.</td></tr>";
                }
            ?>
        </table>
    </section>


    <section id="categories-control">
        <table>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            <?php
                include("../connectDB.php");

                $cat_control = "SELECT * FROM categories";
                $cat_result = mysqli_query($connect, $cat_control);

                if (mysqli_num_rows($cat_result) > 0) {
                    while ($cat = mysqli_fetch_assoc($cat_result)) {
                        echo "<tr>";
                        echo "<td>" . $cat['category_id'] . "</td>";
                        echo "<td>" . $cat['name_category'] . "</td>";
                        echo "<td>" . $cat['status'] . "</td>";
                        if ($cat['status'] == 'активен') {
                            echo "<td><a href='change-status-categ.php?category_id=" . $cat['category_id'] . "&status=активен' onclick='confirmRemove()' class='remove'>Удалить</a></td>";
                        } else {
                            echo "<td><a href='change-status-categ.php?category_id=" . $cat['category_id'] . "&status=неактивен' onclick='confirmRestore()' class='restore'>Восстановить</a></td>";
                        } 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Нет категорий для отображения.</td></tr>";
                }
            ?>

        </table>
    </section>

    <script>
        function confirmRemove(){
            return confirm ("Вы уверена что хотите удалить товар/категорию?");
        }

        function confirmRestore(){
            return confirm ("Вы уверена что хотите восстановить товар/категорию?");
        }

        function confirmDelete(){
            return confirm ("Вы уверены что точно хотите удалить товар навсегда без возможности восстановления?");
        }
    </script>

</body>
</html>