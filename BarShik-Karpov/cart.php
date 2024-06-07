<?php
include "nav.php";
include "connectdb.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Корзина</title>
</head>

<body>
    <main>
        <div class="container">
            <h2 class="text-personal-account">Корзина</h2>
            <ul>
                <?php
                $res = mysqli_query($connect, 'select * from shopping_cart where id_user = ' . $_SESSION['user']);
                while ($row = mysqli_fetch_assoc($res)) {
                    $content_product = json_decode($row['content_shopcart']);
                ?>
                    <li>Name: <?= $content_product->name ?> Description: <?= $content_product->description ?></li>

                <?php
                }
                ?>
            </ul>
        </div>
    </main>

    <footer>
        <div id="ftr-contents">
            <div id="copyright">&copy Карпов Денис Проект BarShik 21-Веб-1</div>
        </div>
    </footer>
</body>

</html>