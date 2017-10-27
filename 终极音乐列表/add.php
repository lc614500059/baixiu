<?php  

function upload() {
   //检验标题和歌手
   if (empty($_POST['title'])) {
       $GLOBALS['message'] = '请输入标题';
       return;
   }

   if (empty($_POST['artist'])) {
       $GLOBALS['message'] = '请输入歌手';
       return;
   }
//    echo '检验ok';
   //============上传音乐验证======================
   if (!isset($_FILES['source'])) {
       $GLOBALS['message'] = '请正确上传音乐文件';
       return;
   }

   $source = $_FILES['source'];

   if ($source['error'] !== UPLOAD_ERR_OK) {
       $GLOBALS['message'] = '请选择音乐文件';
       return;
   }
   //验证音乐大小
   if ($source['size'] > 10 * 1024 * 1024) {
       $GLOBALS['message'] = '音乐文件过大';
       return;
   }

   if ($source['size'] < 1 * 1024 * 1024) {
    $GLOBALS['message'] = '音乐文件过小';
    return;
   }

   //验证音乐类型
   $allowed_types = array('audio/mp3','audio/wma');
   if (!in_array($source['type'], $allowed_types)) {
       $GLOBALS['message'] = '音乐格式不正确';
       return;
   }
    
   $target = './songs/' . uniqid() . '-' . iconv('UTF-8', 'GB2312', $source['name']);
   $sou = iconv('GB2312', 'UTF-8', substr($target, 2));
   if (!move_uploaded_file($source['tmp_name'], $target)) {
       $GLOBALS['message'] = '上传音乐失败';
       return;
   }

   //============上传多个图片验证======================
   if (!isset($_FILES['images'])) {
    $GLOBALS['message'] = '请正确上传图片文件';
    return;
   }

    $images = $_FILES['images'];

   for ($i = 0; $i < count($images['error']); $i++) {
     if ($images['error'][$i] !== UPLOAD_ERR_OK) {
        $GLOBALS['message'] = '请选择图片文件';
        return;
    }
    //验证图片大小
     if ($images['size'][$i] > 1 * 1024 * 1024) {
       $GLOBALS['message'] = '图片文件过大';
       return;
    }

    //验证图片类型
     $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
     if (!in_array($images['type'][$i], $allowed_types)) {
       $GLOBALS['message'] = '图片格式不正确';
       return;
    }
    
     $target = './songs/' . uniqid() . '-' . $images['name'][$i];
     
     if (!move_uploaded_file($images['tmp_name'][$i], $target)) {
       $GLOBALS['message'] = '上传图片失败';
       return;
    }

    $img[] = substr($target, 2);

}
   
   
   //============验证成功保存起来======================
   
   $title = $_POST['title'];
   $artist = $_POST['artist'];
   $images = $img;
   $source = $sou;

   $origin = json_decode(file_get_contents('data.json'), true);

   $origin[] = array(
       'id' => uniqid(),
       'title' => $_POST['title'],
       'artist' => $_POST['artist'],
       'images' => $img,
       'source' => $sou,
   );

   $json = json_encode($origin);
//    var_dump($json);

   file_put_contents('data.json', $json);

   //页面跳转
    header('Location: list.php');

}

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