<?php

// 会員管理機能を使うためのクラスを読み込み
require_once "./var/lib/user.php";

// データベースの接続情報
$host = "";
$dbname = "";
$charset = "";
$user = "";
$password = "";

// セッションを開始
session_start();

// セッションに保存されているサインイン情報を取得
$signin_user = isset($_SESSION["signin_user"]) ? $_SESSION["signin_user"] : null;

// サインインしている場合はタイムラインページへリダイレクト
if ($signin_user) {
    header("Location: timeline.php");
    exit;
}

// サインインページへリダイレクト
header("Location: signin.php");
exit;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/style.css">
  <title>My Twitter Clone</title>
</head>
<body>
</body>
</html>
