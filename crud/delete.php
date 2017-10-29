<?php

//检查是否接收到删除的数据
if (empty($_GET['id'])) {
    exit('<h1>必须传入指定参数</h1>');
}

$id = $_GET['id'];

//建立连接
$connection = mysqli_connect('localhost', 'root', '614500059', 'test');

if (!$connection) {
    exit('<h1>数据库连接失败</h1>');
}

//开始删除
$query = mysqli_query($connection, 'delete from users where id in (' . $id . ');');

if (!$query) {
    exit('<h1>查询失败</h1>');
}

//检验受影响的的行数
$affeted_rows = mysqli_affected_rows($connection);

if ($affeted_rows <= 0) {
    exit('<h1>删除失败</h1>');
}

header('Location: index.php');