<?php
include __DIR__. '/partials/init.php';

$folder = __DIR__. '/imgs/';


// 允許的檔案類型
$imgTypes = [
    //格式對應=>附檔名
'image/jpeg' => '.jpg',
'image/png' => '.png',
];


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

$ext = isset($imgTypes[$_FILES['avatar']['type']]) ? $imgTypes[$_FILES['avatar']['type']] : null ;

if(! empty($ext)){
    $filename = $_FILES['avatar']['name']. $ext;

    if(move_uploaded_file(
        $_FILES['avatar']['tmp_name'],
        $folder. $filename
    )){
            $sql = "INSERT INTO `members`( `avatar`,`name`, `nickname`, 
                    `email`, `password`, `mobile`, `birthday`, `address`, `create_at`)
                    VALUES (
                    ? ,?, ?, 
                    ?, ?, ?, ?, ?, NOW()
                    )";
                //只要從外面來的資料，用戶端進來等等，都看成不安全的資料一律用prepare      

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $filename,
                    $_POST['name'],
                    $_POST['nickname'],
                    $_POST['email'],
                    $_POST['password'],
                    $_POST['mobile'],
                    $_POST['birthday'],
                    $_POST['address'],
                ]);
                
                $output['rowCount'] = $stmt->rowCount(); // 新增的筆數
                if($stmt->rowCount()==1){
                    $output['success'] = true;
                }
                echo json_encode($output);
                exit;
    }

}else{
    $sql = "INSERT INTO `members`( `name`, `nickname`, 
                    `email`, `password`, `mobile`, `birthday`, `address`, `create_at`)
                    VALUES (
                    ?, ?, 
                    ?, ?, ?, ?, ?, NOW()
                    )";
                //只要從外面來的資料，用戶端進來等等，都看成不安全的資料一律用prepare      

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $_POST['name'],
                    $_POST['nickname'],
                    $_POST['email'],
                    $_POST['password'],
                    $_POST['mobile'],
                    $_POST['birthday'],
                    $_POST['address'],
                ]);

                $output['rowCount'] = $stmt->rowCount(); // 新增的筆數
                if($stmt->rowCount()==1){
                    $output['success'] = true;
                }
                echo json_encode($output);
}