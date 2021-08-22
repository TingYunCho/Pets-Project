<?php
include __DIR__ . '/partials/init.php';

// header('Content-Type: application/json');

$img_upload_path = "adopted-imgs/";
if (

    empty($_POST['name']) or
    empty($_POST['breed']) or
    empty($_POST['gender']) or
    empty($_POST['age']) or
    empty($_POST['family']) or
    empty($_POST['intro']) or
    empty($_POST['district'])

) {
    echo json_encode($output);
    exit;
}



//允許的檔案類型
$imgTypes = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
];


if (!empty($_FILES) and !empty($_FILES['avatar'])) {
    //$_FILES['avatar']['type']現在上傳的檔案是什麼把他對應到imgtype
    //ext 是延伸的檔名
    $ext = isset($imgTypes[$_FILES['avatar']['type']]) ? $imgTypes[$_FILES['avatar']['type']] : null;

    
    if (!empty($ext)) {
       $filename = sha1($_FILES['avatar']['name'] . rand()) . $ext;
        //sha1( $_FILES['avatar']['name']. rand())主檔名  $ext 副檔名
        if (move_uploaded_file(
            $_FILES['avatar']['tmp_name'],
            $img_upload_path.$filename
            //可以上傳檔案  檔案類型符合條件  把檔案搬到
        ))  ;
       
    }  
    
}



$sql = "UPDATE `adopted` SET 
                          `name`=?,
                          `breed`=?,
                          `gender`=?,
                          `age`=?,
                          `family`=?,
                          `intro`=?,
                          `district`=?,
                          `avatar`=?
                          

                          WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([

    $_POST['name'],
    $_POST['breed'],
    $_POST['gender'],
    $_POST['age'],
    $_POST['family'],
    $_POST['intro'],
    $_POST['district'],
    $filename,
    $_POST['sid'],
]);
$output['rowCount'] = $stmt->rowCount();
if($stmt->rowCount()==1){
    $output['success'] = true;
}

echo json_encode($output);