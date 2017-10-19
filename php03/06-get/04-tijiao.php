<?php

if ( isset( $_GET[ "name" ] ) && strlen( trim( $_GET[ "name" ] ) ) !=0 
&& isset( $_GET[ "sex" ] ) && strlen( trim( $_GET[ "sex" ] ) ) !=0  ) {
    $name = $_GET[ "name" ];
    $sex = $_GET[ "sex" ];    
} else {
    exit( "<h1>你没有权限访问！</h1>" );
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
    <h1>您的信息是：</h1>
    <h3>姓名：<?php echo $name ?></h3>
    <h3>性别：<?php echo $sex ?></h3>    
</body>
</html>