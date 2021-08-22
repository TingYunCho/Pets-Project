<?php

include __DIR__. '/partials/init.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '資料欄位不足',
    'code' => 0,
    'rowCount' => 0,
    'postData' => $_POST,
];

if (mb_strlen($_POST['article_title'])<2){
    $output['error'] = '標題長度太短';
    $output['code'] = 410;
    echo json_encode($output);
    exit;
}

if (empty($_POST['category_name'])) {
    $output['error'] = '請填寫分類名稱';
    $output['code'] = 420;
    echo json_encode($output);
    exit;
}


if (empty($_POST['sub_category_name'])) {
    $output['error'] = '請填寫次分類名稱';
    $output['code'] = 430;
    echo json_encode($output);
    exit;
}

$sql = "INSERT INTO `pets_blog_articles`(
                `article_title`, `category_name`, 
                `sub_category_name`, `publish_date`, `intro`
                ) VALUES (?, ?, ?, NOW(), ?)";

$stmt = $pdo->prepare($sql);


$stmt->execute([
    $_POST['article_title'],
    $_POST['category_name'],
    $_POST['sub_category_name'],
    $_POST['intro'],
    // $_POST['publish_date'],
]);

$output['rowCount'] = $stmt->rowCount();   //新增的筆數
if ($stmt->rowCount()==1) {
    $output['success'] = true;
}
echo json_encode($output);