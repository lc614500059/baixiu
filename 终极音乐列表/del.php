<?php

if (empty($_GET['id'])) {
    exit('你必须提供要删除的数据id');
}

$id = $_GET['id'];

$json = file_get_contents('data.json');

$array = json_decode($json, true);

foreach ($array as $item) {
    if ($item['id'] ==$id) {
        $index = array_search($item, $array);
        array_splice($array, $index, 1);
        $new_json = json_encode($array);
        file_put_contents('data.json', $new_json);
        break;
    }
}

header('Location: list.php');
