<?php
include __DIR__. '/partials/init.php';

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

if (! isset($_POST['account']) or ! isset($_POST['password'])) {
    $output['error'] = '沒有帳號或沒有密碼';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT * FROM `admin` WHERE account=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST['account']]);
$a = $stmt->fetch(); 

if (empty($a)) {
    $output['error'] = '帳號錯誤';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// if(! password_verify($_POST['password'], $a['password'])) {
//     $output['error'] = '密碼錯誤';
//     $output['code'] = 405;
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit; 
// }
    $output['success'] = true;
    $output['code'] = 200;

    $_SESSION['user'] = $a;
    
echo json_encode($output, JSON_UNESCAPED_UNICODE);