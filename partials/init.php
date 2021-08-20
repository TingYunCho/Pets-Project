<?php

// 在init.php引用db_connect資料庫
require __DIR__. '/db_connect.php';

// 因為所有頁面都需要取得$_SESSION狀態，因此在這邊直接設定一個通用的規則，如果沒有啟用session，則將它啟用
if (! isset($_SESSION)) {
    session_start();
}
// 設定好後要在各頁面引用init.php，就可以同時啟用資料庫及session