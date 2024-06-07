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

</head>
<body>
    <div class="sidebar">
        <a href="admin.php" id="add-met-link">Управление товарами</a>
        <a href="#" id="add-programs-link">Управление пользователями</a>
        <a href="../exit" id="logout-link">Выйти</a>
    </div>

    <div class="content" id="content-tovarfs">
        <!-- Контент для управления пользователми -->
        <h2>Управление пользователями</h2>

    <section id="users-control">    
        <table>
            <tr>
                <th>ID</th>
                <th>Почта</th>
                <th>Пароль</th>
                <th>Бонусные баллы</th>
                <th>Роль</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            <?php  
                include("../connectDB.php");  
                
                $user_control = "SELECT * FROM users WHERE role = 'user' ";  
                $user_result = mysqli_query($connect, $user_control);  
                
                if (mysqli_num_rows($user_result) > 0) {  
                    while ($user = mysqli_fetch_assoc($user_result)) {  
                        echo "<tr>";  
                        echo "<td>" . $user['id_user'] . "</td>";  
                        echo "<td>" . $user['email'] . "</td>";  
                        echo "<td>" . $user['cash_password'] . "</td>";  
                        echo "<td>" . $user['bonus_balls'] . "</td>";  
                        echo "<td>" . $user['role'] . "</td>";  
                        echo "<td>" . $user['status'] . "</td>";  
                
                        if($user['status'] == 'заблокирован'){ 
                            echo "<td><a href='block-users.php?user_id=" . $user['id_user'] . "' class='unblock'>Разблокировать</a></td>"; 
                        } else { 
                            echo "<td><a href='block-users.php?user_id=" . $user['id_user'] . "' class='block'>Заблокировать</a></td>"; 
                        } 
                        
                        echo "</tr>";  
                    }  
                } else {  
                    echo "<tr><td colspan='8'>Пользователи не найдены.</td></tr>";  
                }  
            ?>
        </table>
    </section>
    </div>

</body>
</html>