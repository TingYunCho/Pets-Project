<?php

include __DIR__. '/partials/init.php';

$sid = isset($_GET['article_sid']) ? intval($_GET['article_sid']) : 0;
if(! empty($sid)) {
    $sql = "DELETE FROM `pets_blog_articles` WHERE `article_sid`=$sid";
    $stmt = $pdo->query($sql);
}

if(isset($_SERVER['HTTP_REFERER'])){
    header("location:".$_SERVER['HTTP_REFERER']);
} else {
    header('location:article-list.php');
}