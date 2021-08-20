<?php

// 以下連線資料如有錯誤，則網頁上會顯示錯誤訊息，若正確則呈現空白頁
$db_host = 'localhost';     // 欲連線的主機名稱
$db_name = 'pets_project';  // 欲連線的資料庫名稱
$db_user = 'tingyun';       // 欲連線的用戶名稱，之前在PHPmyadmin的root新增的使用者帳號
$db_pass = 'admin';         // 欲連線的用戶密碼，之前在PHPmyadmin的root新增的使用者密碼，若沒有設定密碼則可為空字串
$db_charset = 'utf8';       // 欲連線的資料編碼

// dsn = data source name，以下設定的字串中間都不要有任何空白 
$dsn = "mysql:host={$db_host};dbname={$db_name};charset={$db_charset}";

// PDO連線設定，為一個陣列形式，PDO後的::表示這個常數定義在'類別'
$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,         // 這邊設定'發生錯誤'時的屬性
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,    // 這邊設定拿取資料時，每筆資料都是'ASSOC關聯式陣列陣列'
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",    // 這邊設定第一次做完連線後要執行的內容，並且無論資料進出，都用utf8編碼來執行
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);