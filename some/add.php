<?php

function upload() {
    if (empty($_POST['title'])) {
        $GLOBALS['message'] = '请输入标题';
        return;
    }

    if (empty($_POST['artist'])) {
        $GLOBALS['message'] = '请输入歌手';
        return;
    }
    // echo '校验文件';
// ====================接收音乐=========================
    if (!isset($_FILES['source'])) {
        $GLOBALS['message'] = '正确提交文件';
        return;
    }

    $source = $_FILES['source'];

    if ($source['error'] !== UPLOAD_ERR_OK) {
        $GLOBALS['message'] = '请选择音乐文件';
        return;
    }
    // echo '上传成功';

    //校验文件的大小
    if ($source['size'] > 10 * 1024 * 1024) {
        $GLOBALS['message'] = '音乐文件过大';
        return;
    }

    if ($source['size'] < 1 * 1024 * 1024) {
        $GLOBALS['message'] = '音乐文件过小';
        return;
    }
    //校验文件的类型
    $allowed_types = array('audio/mp3', 'audio/wma');
    if (!in_array($source['type'], $allowed_types)) {
        $GLOBALS['message'] = '这是不支持的音乐格式';
        return;
    }

    $target = './songs/' . uniqid() . '-' . $source['name'];

    $sou = substr($target, 2);

    if (!move_uploaded_file($source['tmp_name'], $target)) {
        $GLOBALS['message'] = '上传音乐失败';
        return;
    }
 // ====================接收多张图片=========================
    if (!isset($_FILES['images'])) {
        $GLOBALS['message'] = '正确提交文件';
        return;
    }

    $images = $_FILES['images'];

  for ($i = 0; $i < count($images['error']); $i++) {      
    if ($images['error'][$i] !== UPLOAD_ERR_OK) {
        $GLOBALS['message'] = '请选择图片文件';
        return;
    }
    // echo '上传成功';

    //校验文件的大小
    if ($images['size'][$i] > 1 * 1024 * 1024) {
        $GLOBALS['message'] = '图片文件过大';
        return;
    }
    //校验文件的类型
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($images['type'][$i], $allowed_types)) {
        $GLOBALS['message'] = '这是不支持的图片格式';
        return;
    }

    $target = './songs/' . uniqid() . '-' . $images['name'][$i];


    if (!move_uploaded_file($images['tmp_name'][$i], $target)) {
        $GLOBALS['message'] = '上传图片失败';
        return;
    }
    $img[] = substr($target, 2);
    
  }

//图片音乐都成功
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $images = $img;
    $source = $sou;

    $origin = json_decode(file_get_contents('storage.json'), true);

    $origin[] = array(
        'id' => uniqid(),
        'title' => $_POST['title'],
        'artist' => $_POST['artist'],
        'images' => $img,
        'source' => $sou,
    );

    $json = json_encode($origin);

    file_put_contents('storage.json', $json);

    header('Location: list.php');

}  

// $add = file_put_contents('storage.json', $text, FILE_APPEDN);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    upload();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>添加新音乐</title>
  <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
  <div class="container py-5">
    <h1 class="display-4">添加新音乐</h1>
    <hr>
    <?php if (isset($message)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $message; ?>
    </div>
    <?php endif ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="form-group">
        <label for="title">标题</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="artist">歌手</label>
        <input type="text" class="form-control" id="artist" name="artist">
      </div>
      <div class="form-group">
        <label for="images">海报</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
      </div>
      <div class="form-group">
        <label for="source">音乐</label>
        <!-- accept可以限制文件域能够选择的文件种类，值是MIME Type -->
        <input type="file" class="form-control" id="source" name="source" accept="audio/*">
      </div>
      <button class="btn btn-primary btn-block">保存</button>
    </form>
  </div>
</body>
</html>
