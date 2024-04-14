<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>БарШик</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/reg.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src='main.js'></script>

    </head>
<body>




    <!-- Модальное окно Регистрация -->
    <div class="modal fade" id="regModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Регистрация</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <form action="reg-db.php" method="post" class="reg-form">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Почта : </label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="cash_password" id="floatingPassword" placeholder="пароль" required>
                            <label for="floatingPassword">Пароль : </label>
                        </div>
                        <button type="submit">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно Входа -->
    <div class="modal fade" id="signModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Вход</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="signIn-db.php" method="post" class="reg-form">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Почта : </label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="cash_password" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Пароль : </label>
                        </div>
                        <button type="submit">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <nav>
        <h1>БарШик</h1>
        <ul class="nav-menu">
            <li><a href="/" class="btn btn-primary">Главная</a></li>

        <?php 
            session_start(); // Начинаем сессию

            // Проверяем, авторизован ли пользователь
            if(isset($_SESSION['user_id'])) {
                // Пользователь авторизован
                echo '<li><a href="personal-cab.php" class="btn btn-primary">Личный кабинет</a></li>';
                echo '<li><a href="logout.php" class="btn btn-primary">Выйти</a></li>';
            } else {
                // Пользователь не авторизован
                echo '<li><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#regModal">Регистрация</button></li>';
                echo '<li><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signModal">Вход</button></li>';
            }
        ?>

            <li><a href="reviews.php" class="btn btn-primary">Отзывы</a></li>
        </ul>
    </nav>

        <main>
            <section class="menu">
                <h2>Меню</h2>
                    <ul>
                        <li><a href="#">Газированные напитки</a></li>
                        <li><a href="#">Соки</a></li>
                        <li><a href="#">Смузи</a></li>
                        <li><a href="#">Коктейли</a></li>
                        <li><a href="#">Вода</a></li>
                    </ul>
            </section>

            <section class="drinks">
                <h2>Газированные напитки</h2>
                    <ul>
                        <li>Кока-кола</li>
                        <li>Фанта</li>
                        <li>Спрайт</li>
                        <li>Минеральная вода</li>
                        <li>Сок</li>
                        <li>Молочный коктейль</li>
                        <li>Смузи</li>
                    </ul>
            </section>
        </main>

    <footer>
        <p>БарШик &copy; 2024 Карпов Денис 21-Веб-1</p>
    </footer>
</body>
</html>
