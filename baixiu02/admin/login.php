<?php

//载入配置文件
require_once  "../config.php";

//给一个盒子
session_start();

//验证
function login () {
  if (empty($_POST['email'])) {
    $GLOBALS['message'] = '请输入邮箱';
    return;
  }

  if (empty($_POST['password'])) {
    $GLOBALS['message'] = '请输入密码';
    return;
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if (!$conn) {
    exit('<h1>数据库连接失败</h1>');
  }

  $query  = mysqli_query($conn, "select * from users where email = '{$email}' limit 1;");

  if (!$query) {
    $GLOBALS['message'] = '登录失败，请重试！';
    return;
  }

  $user = mysqli_fetch_assoc($query);

  if (!$user) {
    $GLOBALS['message'] = '邮箱与密码匹配不正确';
    return;
  }

  if ($user['password'] !== $password) {
    $GLOBALS['message'] = '邮箱与密码匹配不正确';
    return;
  }

  $_SESSION['current_login_user'] = $user;

  //响应
  header('Location: /admin/');


}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  login();
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/animate/animate.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
</head>
<body>
  <div class="login">
    <!-- 可以通过在 form 上添加 novalidate 取消浏览器自带的校验功能 -->
    <!-- autocomplete="off" 关闭客户端的自动完成功能 -->
    <form class="login-wrap<?php echo isset($message) ? ' shake animated' : '' ?>" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate autocomplete="off">
      <img class="avatar" src="/static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if (isset($message)): ?>
      <div class="alert alert-danger">
        <strong>错误！</strong> <?php echo $message; ?>
      </div>
      <?php endif ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="邮箱" autofocus value="<?php echo empty($_POST['email']) ? '' : $_POST['email'] ?>">
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="密码">
      </div>
      <button class="btn btn-primary btn-block">登 录</button>
    </form>
  </div>
</body>
</html>
