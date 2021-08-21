<?php
include __DIR__. '/partials/init.php';

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'rowCount' => 0,
    'postData' => $_POST,
];

if(mb_strlen($_POST['name'])<2){
    $output['error'] = '姓名長度太短';
    $output['code'] = 410;
    echo json_encode($output);
    exit;
}

if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $output['error'] = 'email 格式錯誤';
    $output['code'] = 420;
    echo json_encode($output);
    exit;
}

$sql = "INSERT INTO `customers`(
                    `name`, `email`, `mobile`,
                    `birthday`, `address`, `created_at`
                    ) VALUES (
                        ?, ?, ?,
                        ?, ?, NOW()
                    )";
//只要從外面來的資料，用戶端進來等等，都看成不安全的資料一律用prepare              

$stmt = $pdo->prepare($sql);
$stmt->execute([
                $_POST['name'],
                $_POST['email'],
                $_POST['mobile'],
                $_POST['birthday'],
                $_POST['address'],
]);

$output['rowCount'] = $stmt->rowCount(); // 新增的筆數
if($stmt->rowCount()==1){
    $output['success'] = true;
}
echo json_encode($output);