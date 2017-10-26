<?php

//验证
if (empty($_GET['id'])) {
    exit('你必须提供要删除的数据id');
}

//确保客户提交了ID
$id = $_GET['id'];

//读取数据
$json = file_get_contents('storage.json');
//反序列化
$array = json_decode($json, true);
//遍历数组
foreach ($array as $item) {
    if ($item['id'] == $id) {
        $index = array_search($item, $array);
        array_splice($array, $index, 1);
        $new_json = json_encode($array);
        file_put_contents('storage.json', $new_json);
        break;
    }
}

header('Location: list.php');