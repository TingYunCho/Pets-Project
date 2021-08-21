<?php

include __DIR__. '/partials/init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if(! empty($sid)) {
    $sql = "DELETE FROM `pets_blog_articles` WHERE `sid`=$sid";
    $stmt = $pdo->query($sql);
}

if(isset($_SERVER['HTTP_REFERER'])){
    header("location:".$_SERVER['HTTP_REFERER']);
} else {
    header('location:article-list.php');
}