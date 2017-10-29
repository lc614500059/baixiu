<?php

//建立连接
$connection = mysqli_connect('localhost', 'root', '614500059', 'test');

if (!$connection) {
  exit('<h1>数据库连接失败</h1>');
}

//开始查询
$query = mysqli_query($connection, 'select * from users');

if (!$query) {
  exit('<h1>查询失败</h1>');
}

$date = substr(date('Y-m-d'), -10, 4);
// echo date('Y-m-d');
// echo $date;

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
    <h1 class="heading">用户管理 <a class="btn btn-link btn-sm" href="add.php">添加</a></h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>头像</th>
          <th>姓名</th>
          <th>性别</th>
          <th>年龄</th>
          <th class="text-center" width="140">操作</th>
        </tr>
      </thead>
      <tbody>
      <!-- 遍历结果集 -->
      <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
          <th scope="row"><?php echo $row['id']; ?></th>
          <td><img src="<?php echo $row['avatar']; ?>" class="rounded" alt=""></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['gender'] == 0 ? '♀':'♂'; ?></td>
          <td><?php echo $date-substr($row['birthday'], -10, 4); ?></td>
          <td class="text-center">
            <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">编辑</a>
            <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>">删除</a>
          </td>
        </tr>       
        <?php endwhile ?>
      </tbody>
    </table>
    <ul class="pagination justify-content-center">
      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
  </main>
</body>
</html>
