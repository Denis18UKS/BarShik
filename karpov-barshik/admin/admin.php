<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Администратор</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/admin.css'>
</head>
<body>
    <div class="admin-panel">
        <section class="users-section">
            <h2>Управление пользователями</h2>
            <div class="user-list">
                <!-- Список пользователей --><?php
                // Подключение к базе данных

                include "../connect.php";

                if ($connect->connect_error) {
                    die("Connection failed: " . $connect->connect_error);
                }

                // Получение списка пользователей
                $sql = "SELECT * FROM users";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    // Вывод списка пользователей
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>ID: " . $row["user_id"] . " - Email: " . $row["email"] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "0 результатов";
                }

                $connect->close();
                ?>
            </div>
            <div class="user-actions">
                <form id="block-user-form">
                    <label for="block-user-input">Email пользователя для блокировки:</label>
                    <input type="email" id="block-user-input" name="email">
                    <button type="submit">Заблокировать</button>
                </form>
                <form id="unblock-user-form">
                    <label for="unblock-user-input">Email пользователя для разблокировки:</label>
                    <input type="email" id="unblock-user-input" name="email">
                    <button type="submit">Разблокировать</button>
                </form>
            </div>
        </section>

        <section class="products-section">
            <h2>Управление товарами</h2>
            <div class="product-list">
                <!-- Список товаров -->
            </div>
            <div class="product-actions">
                <form id="add-product-form">
                    <label for="product-name">Название товара:</label>
                    <input type="text" id="product-name" name="name">
                    <button type="submit">Добавить товар</button>
                </form>
                <form id="edit-product-form">
                    <label for="edit-product-id">ID товара для редактирования:</label>
                    <input type="text" id="edit-product-id" name="id">
                    <button type="submit">Редактировать</button>
                </form>
                <form id="delete-product-form">
                    <label for="delete-product-id">ID товара для удаления:</label>
                    <input type="text" id="delete-product-id" name="id">
                    <button type="submit">Удалить</button>
                </form>
            </div>
        </section>
    </div>

    <script src="main.js"></script>
</body>
</html>