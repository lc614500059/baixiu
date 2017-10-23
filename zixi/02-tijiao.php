<?php

if ( isset($_GET[ "id" ]) && strlen( trim( $_GET[ "id" ] ) ) !=0
&& isset($_GET[ "username" ]) && strlen( trim( $_GET[ "username" ] ) ) !=0
&& isset($_GET[ "age" ]) && strlen( trim( $_GET[ "age" ] ) ) !=0
&& isset($_GET[ "email" ]) && strlen( trim( $_GET[ "email" ] ) ) !=0
&& isset($_GET[ "url" ]) && strlen( trim( $_GET[ "url" ] ) ) !=0  ) {
  $id = $_GET[ "id" ];    
  $username = $_GET[ "username" ];
  $age = $_GET[ "age" ];
  $email = $_GET[ "email" ];
  $url = $_GET[ "url" ];
} else {
  exit( "<h1>添加失败<h1/>" );
}

$col = "\n" . $id . " | " . $username . " | " . $age . " | " . $email . " | " . $url;
// echo  $col;
$file = "names.txt";

file_put_contents( $file, $col, FILE_APPEND);

// ========================================================================

$text = file_get_contents( 'names.txt' );

$lines = explode( "\n", $text );

foreach ($lines as $item) {
    if( !$item ) continue;
    $cols = explode( '|', $item );
    $data[] = $cols;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>全部人员信息表</h1>
    <table>
     <thead>
       <tr>
           <th>编号</th>
           <th>姓名</th>
           <th>年龄</th>
           <th>邮箱</th>
           <th>网址</th>
       </tr>
     <thead/>
     <tbody>
      <?php foreach ( $data as $line ): ?>
      <tr>
      <?php foreach ( $line as $col ): ?>
     
      <?php $col = trim( $col ); ?>
      <?php if ( strpos( $col, 'http://' ) === 0 ): ?>
       <td><a href="<?php echo strtolower($col); ?>"><?php echo substr( $col, 7 ); ?></a></td>
      <?php else: ?>
       <td>    
       <?php echo $col; ?></td>
       <?php endif ?>
       <?php endforeach ?>
      </tr>
      <?php endforeach ?>     
     <tbody/>
    </table>
</body>
</html>