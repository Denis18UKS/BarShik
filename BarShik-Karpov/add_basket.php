<?php
require_once 'connectdb.php';
$data = file_get_contents('php://input');
$request = json_decode($data, true);

$res = mysqli_query($connect, 'select * from products where id  = ' . $request['id']);
$row = mysqli_fetch_assoc($res);

$arr = [];
$arr['id'] = $request['id'];
$arr['name'] = $row['name'];
$arr['description'] = $row['description'];
$arr['category_id'] = $row['category_id'];
$arr['price '] = $row['price'];
$arr['image'] = $row['image'];

mysqli_query($connect, "insert into shopping_cart (id_user, content_shopcart) values (6, '" . json_encode($arr, true) . "')");
