<?php

require __DIR__. '/partials/init.php';

$stmt = $pdo->query("SELECT * FROM `pets_blog_articles` LIMIT 10");

while($r = $stmt->fetch()){
    echo "<p>{$r['article_sid']}:{$r['article_title']}</p>";
}