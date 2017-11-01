<?php  

$data = array(
    array(
        'id' => 1,
        'name' => '梅西',
        'age' => 29
    ),
    array(
        'id' => 2,
        'name' => '小白',
        'age' => 34
    ),
    array(
        'id' => 3,
        'name' => '啦啦',
        'age' => 18
    ),
    array(
        'id' => 4,
        'name' => '小狮子',
        'age' => 27
    )
);

if (empty($_GET['id'])) {
    $json = json_encode($data);
    echo $json;
} else {
    foreach ($data as $item) {
        if ($item['id'] != $_GET['id']) continue;
        $json = json_encode($item);
        echo $json;
    }
}
