<?php 
// 定义的模板
class Person {
    public function sayHello () {
        echo "<h1>Hello</h1>";
    }
}

// 利用模板创建对象
$p = new Person();

// 调用对象的方法
$p->sayHello();



?>