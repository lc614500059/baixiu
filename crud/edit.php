<?php

//接收要修改数据的id
if (empty($_GET['id'])) {
  exit('<h1>必须传入指定的参数</h1>');
}

$id = $_GET['id'];

//1.建立连接
$connection = mysqli_connect('localhost', 'root', '614500059', 'test');

if (!$connection) {
  exit('<h1>链接数据库失败</h1>');
}

//2.开始修改
$query = mysqli_query($connection, "select * from users where id = {$id} limit 1;");

if (!$query) {
   exit('<h1>查询数据失败</h1>');
}

$user = mysqli_fetch_assoc($query);

if (!$user) {
  exit('<h1>找不到要编辑的数据</h1>');
}

// //响应
// header('Location: index.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>XXX管理系统</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">XXX管理系统</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">用户管理</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">商品管理</a>
      </li>
    </ul>
  </nav>
  <main class="container">
    <h1 class="heading">编辑“<?php echo $user['name']; ?>”</h1>
    <form action="">
      <div class="form-group">
        <label for="avatar">头像</label>
        <input type="file" class="form-control" id="avatar">
      </div>
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" id="name" value="<?php echo $user['name']; ?>">
      </div>
      <div class="form-group">
        <label for="gender">性别</label>
        <select class="form-control" id="gender">
          <option value="-1">请选择性别</option>
          <option value="1" value="<?php echo $user['gender'] === '1' ? ' selected': '' ?>">男</option>
          <option value="0" value="<?php echo $user['gender'] === '0' ? ' selected': '' ?>">女</option>
        </select>
      </div>
      <div class="form-group">
        <label for="birthday">生日</label>
        <input type="date" class="form-control" id="birthday" value="<?php echo $user['birthday']; ?>">
      </div>
      <button class="btn btn-primary">保存</button>
    </form>
  </main>
</body>
</html>
