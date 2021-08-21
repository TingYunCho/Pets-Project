<?php
include __DIR__. '/partials/init.php';

header('Content-Type: application/json');

// 要存放圖檔的資料夾
$folder = __DIR__. '/imgs/';


// 允許的檔案類型
$imgTypes = [
    //格式對應=>附檔名
'image/jpeg' => '.jpg',
'image/png' => '.png',
];

$output = [
'success' => false,
'error' => '資料欄位不足',
'code' => 0,
'postData' => $_POST,
];

if(empty($_POST['nickname'])){
    echo json_encode($output);
    exit;
}

$ext = isset($imgTypes[$_FILES['avatar']['type']]) ? $imgTypes[$_FILES['avatar']['type']] : null ; // 取得副檔名

// 如果是允許的檔案類型
if(! empty($ext)){
    $filename = $_FILES['avatar']['name']. $ext;

    if(move_uploaded_file(
        $_FILES['avatar']['tmp_name'],
        $folder. $filename
    )){
        $sql = "UPDATE `members` SET 
                                `avatar`=?,
                                `name`=?,
                                `nickname`=?,
                                `password`=?,
                                `mobile`=?,
                                `birthday`=?,
                                `address`=?
                                WHERE `id`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $filename,
            $_POST['name'],
            $_POST['nickname'],
            $_POST['password'],
            $_POST['mobile'],
            $_POST['birthday'],
            $_POST['address'],
            $_SESSION['user']['id'],
        ]);

        $output['rowCount'] = $stmt->rowCount(); // 修改的筆數

        if($stmt->rowCount()) {

            $_SESSION['user']['avatar'] = $filename;
            $_SESSION['user']['nickname'] = $_POST['nickname'];
            $output['error'] = '';
            $output['success'] = true;
        }else {
            $output['error'] = '資料沒有修改';
        }
        
        echo json_encode($output);
        exit;

    }
}else{
    $sql = "UPDATE `members` SET 
                                `name`=?,
                                `nickname`=?,
                                `password`=?,
                                `mobile`=?,
                                `birthday`=?,
                                `address`=?
                                WHERE `id`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['name'],
            $_POST['nickname'],
            $_POST['password'],
            $_POST['mobile'],
            $_POST['birthday'],
            $_POST['address'],
            $_SESSION['user']['id'],
        ]);

        $output['rowCount'] = $stmt->rowCount(); // 修改的筆數

        if($stmt->rowCount()) {
            $_SESSION['user']['nickname'] = $_POST['nickname'];
            $output['error'] = '';
            $output['success'] = true;
        }else {
            $output['error'] = '資料沒有修改';
        }
        
        echo json_encode($output);

}