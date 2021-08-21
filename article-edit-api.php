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

// 為避免拜訪article-edit-api.php時跳錯誤訊息
if (
    empty($_POST['sid']) or
    empty($_POST['article_title']) or
    empty($_POST['category_name']) or
    empty($_POST['sub_category_name']) or
    empty($_POST['publish_date'])
) {
    echo json_encode($output);
    exit;
}

if (mb_strlen($_POST['article_title'])<2){
    $output['error'] = '標題長度太短';
    $output['code'] = 410;
    echo json_encode($output);
    exit;
}

if (empty($_POST['category_name'])) {
    $output['error'] = '未填寫分類名稱';
    $output['code'] = 420;
    echo json_encode($output);
    exit;
}

if (empty($_POST['sub_category_name'])) {
    $output['error'] = '未填寫次分類名稱';
    $output['code'] = 430;
    echo json_encode($output);
    exit;
}


$sql = "UPDATE `pets_blog_articles` SET 
        `article_title`=?,`category_name`=?,`sub_category_name`=?,`publish_date`=?
        WHERE `sid`=?";


$stmt = $pdo->prepare($sql);


$stmt->execute([
    $_POST['article_title'],
    $_POST['category_name'],
    $_POST['sub_category_name'],
    $_POST['publish_date'],
    $_POST['sid'],
]);

$output['rowCount'] = $stmt->rowCount();   //修改的筆數
if ($stmt->rowCount()==1) {
    $output['success'] = true;
    $output['error'] = '';
} else {
    $output['error'] = '資料沒有修改';
    echo json_encode($output);
    exit;
}

echo json_encode($output);
// header('location:article-list.php');