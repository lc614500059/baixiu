<?php 

$integer = 123;
echo is_int( $integer ) . "<br />\n";

$float = 1.234;
echo is_float( $float ) . "<br />\n";

$string = "123";
echo is_string( $string ) . "<br />\n";

$boolean = true;
echo is_bool( $boolean ) . "<br />\n";

$array = array( 1, 2, 3 );
echo is_array( $array ) . "<br />\n";

class Person {}
$p = new Person();
echo is_object( $p ) . "<br />\n";


$file = fopen( "./db.file", "w" );//本地创建db.file的文件
echo is_resource( $file ) . "<br />\n";
fclose( $file );//关闭资源，释放资源


$null = null;
echo is_null( $null ) . "<br />\n";


?>