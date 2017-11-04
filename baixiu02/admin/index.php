<?php

require_once "../config.php";

//校验数据当前访问用户的箱子 有没有登录的登录标识
session_start();

if (empty($_SESSION['current_login_user'])) {
  //没有当前用户的用户信息，意味着没有登录
  header('Location: /admin/login.php/');
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
  exit('<h1>数据库连接失败</h1>');
}
//查询文章
$query  = mysqli_query($conn, "select count(*) from posts;");

if (!$query) {
  $GLOBALS['message'] = '查询失败，请重试！';
  return;
}

$articles = mysqli_fetch_row($query)[0];


//查询草稿
$query1  = mysqli_query($conn, "select count(*) from `posts` where status = 'drafted';");

if (!$query1) {
  $GLOBALS['message'] = '查询失败，请重试！';
  return;
}

$drafted = mysqli_fetch_row($query1)[0];


//查询分类
$query2  = mysqli_query($conn, "select count(*) from categories;");

if (!$query2) {
  $GLOBALS['message'] = '查询失败，请重试！';
  return;
}

$categories = mysqli_fetch_row($query2)[0];


//查询评论
$query3  = mysqli_query($conn, "select count(*) from comments;");

if (!$query3) {
  $GLOBALS['message'] = '查询失败，请重试！';
  return;
}

$comments = mysqli_fetch_row($query3)[0];


//查询待审核
$query4  = mysqli_query($conn, "select count(*) from comments where status = 'held';");

if (!$query4) {
  $GLOBALS['message'] = '查询失败，请重试！';
  return;
}

$held = mysqli_fetch_row($query4)[0];



?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include 'inc/navbar.php'; ?>

    <div class="container-fluid">
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.html" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><strong><?php echo $articles; ?></strong>篇文章（<strong><?php echo $drafted; ?></strong>篇草稿）</li>
              <li class="list-group-item"><strong><?php echo $categories; ?></strong>个分类</li>
              <li class="list-group-item"><strong><?php echo $comments; ?></strong>条评论（<strong><?php echo $held; ?></strong>条待审核）</li>
            </ul>
          </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>

  <?php $current_page = 'index'; ?>
  <?php include 'inc/sidebar.php'; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
