<?php

// セッションを開始
session_start();

// サインイン情報を破棄
$_SESSION = array();

// セッションを破棄
session_destroy();

// タイムラインにリダイレクト
header("Location: ./timeline.php");
exit;
