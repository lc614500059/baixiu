<?php

$text = file_get_contents('storage.json');

$array = json_decode($text);

// print_r($array);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>音乐列表</title>
  <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
  <div class="container py-5">
    <h1 class="display-4">音乐列表</h1>
    <hr>
    <div class="mb-3">
      <a href="add.html" class="btn btn-secondary btn-sm">添加</a>
    </div>
    <table class="table table-bordered table-striped table-hover">
      <thead class="thead-dark">
        <tr>
          <th class="text-center">标题</th>
          <th class="text-center">歌手</th>
          <th class="text-center">海报</th>
          <th class="text-center">音乐</th>
          <th class="text-center">操作</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php foreach ($array as $item): ?>
        <tr>
          <td><?php echo $item -> title ?></td>
          <td><?php echo $item -> artist ?></td>
          <td><img src="<?php echo $item -> images ?>" alt=""></td>
          <td><audio src="<?php echo $item -> source ?>" controls></audio></td>
          <td><button class="btn btn-danger btn-sm">删除</button></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>
</html>
