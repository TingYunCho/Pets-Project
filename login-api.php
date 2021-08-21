<?php 
include __DIR__ . '/partials/init.php';


$output = [
    'success' => false,
    'error' => '', 
    'code' => 0,
];

if(!isset($_POST['account']) or !isset($_POST['password'])){
    $output['error'] = '沒有帳號資料或沒有密碼';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT * FROM members WHERE email= ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(
    [$_POST['account']]
);
$m = $stmt->fetch();



if(empty($m)){
    $output['error'] = '帳號錯誤';
    $output['code'] = 401;
    // $output['account'] = $_POST['account'];
    // $output['account'] = $_POST['account'];


    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
 }

if(! ($_POST['password'] == $m['password'])){
    $output['error'] = '密碼錯誤' ;
    $output['code'] = 405 ;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$output['success'] = true;
$output['code'] = 200;
$_SESSION['user'] = $m;

echo json_encode($output, JSON_UNESCAPED_UNICODE);

