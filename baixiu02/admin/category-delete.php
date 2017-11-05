<?php

require_once '../functions.php';

if (empty($_GET['id'])) {
    exit('未传入参数');
}

$id = $_GET['id'];

  // delete from categories where id in (4,5);
$rows = xiu_execute('delete from categories where `id` in (' . $id . ');');


header('Location: /admin/categories.php');