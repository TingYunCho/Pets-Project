<?php

require __DIR__. '/partials/init.php';
$stmt = $pdo->query("SELECT * FROM `pets_blog_articles` LIMIT 3");
echo json_encode( $stmt->fetch(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
