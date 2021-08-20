<?php

// 此頁主要用來除錯，看loin-api的session是否正常執行

session_start();
header('Content-Type: application/json');
echo json_encode($_SESSION, JSON_UNESCAPED_UNICODE);