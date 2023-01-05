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

// サインインしているユーザー情報を取得
$signin_user = isset($_SESSION["signin_user"]) ? $_SESSION["signin_user"] : null;

// サインインする
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

// サインイン処理
if ($email && $password) {
    // データベースに接続
    $user_model = new User($host, $dbname, $charset, $user, $password);

    // サインインする
    $signin_user = $user_model->signin($email, $password);

    // サインイン失敗
    if (!$signin_user) {
        $error_msg = "サインインに失敗しました。";
    }
}

// サインインしている場合はタイムラインにリダイレクト
if ($signin_user) {
    header("Location: ./timeline.php");
    exit;
}

// サインインページを表示
require_once "./var/view/signin.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>My Twitter Clone</title>
</head>
<body>
    <header>
        <h1><a href="./index.php">My Twitter Clone</a></h1>
    </header>
    <main>
        <h2>サインイン</h2>
        <form action="./signin.php" method="post">
            <p>
                <label for="email">メールアドレス:</label>
                <input type="text" name="email" id="email" required>
            </p>
            <p>
                <label for="password">パスワード:</label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <button type="submit" name="signin">サインイン</button>
            </p>
            <p>
                <a href="./signup.php">サインアップ</a>
            </p>
        </form>
    </main>
    <footer>
        <p>&copy; My Twitter Clone</p>
    </footer>
</body>
</html>
