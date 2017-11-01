<?php

if (empty($_POST['username']) || empty($_POST['username'])) {
    exit('请提交用户名和密码');
}

$username = $_POST['username'];
$password = $_POST['password'];
if ($username === 'admin' && $password === '123') {
    exit('成功');
}

exit('用户名或者密码错误');


