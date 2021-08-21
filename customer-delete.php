<?php
include __DIR__. '/partials/init.php';

//使用GET因為是從URL後?改值的，不用prepare是因為值只有一個而且已轉換為整數
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if(! empty($sid)){
    $sql = "DELETE FROM `customers` WHERE sid=$sid";
    $stmt = $pdo->query($sql);
}
//$_SERVER['HTTP_REFERER']從哪個頁面連過來的  2021 08 10 09 01 01   00:57:23
//不一定有資料
if(isset($_SERVER['HTTP_REFERER'])){ 
    header("Location: " . $_SERVER['HTTP_REFERER']);
}else{
    header('Location: data-list.php');
}


