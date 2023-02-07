<?php

  require_once '../includes/config/sessionConfig.php';
  require_once '../includes/config/db.php';
  require_once '../includes/config/constants.php';
  require_once '../includes/debug/debug.php';
  require_once '../includes/debug/functions.php';
  require_once '../includes/private/commonFunction.php';

// 認証
// ユーザー名とメールアドレスの照合
if (isset($_POST['username']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // データベースからユーザー情報を取得
    $query = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $result = mysqli_query($conn, $query);

    // ユーザーが存在しているか確認
    if (mysqli_num_rows($result) > 0) {
        // ユーザーが存在する場合
        $user = mysqli_fetch_assoc($result);

        // 新しいパスワードの生成
        $new_password = bin2hex(random_bytes(5));

        // パスワードの暗号化
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // 新しいパスワードをデータベースに保存
        $update_query = "UPDATE users SET password = '$hashed_password' WHERE id = {$user['id']}";
        if (mysqli_query($conn, $update_query)) {
            // パスワードをメールで送信
            $to = $email;
            $subject = "新しいパスワード";
            $message = "新しいパスワードは $new_password です。\n\nこのパスワードを使ってログインしてください。";
            $headers = "From: no-reply@example.com";
            if (mail($to, $subject, $message, $headers)) {
                // パスワードをメールで送信できた場合
                echo "新しいパスワードをメールで送信しました。";
            } else {
                // パスワードをメールで送信できなかった場合
                echo "パスワードをメールで送信できませんでした。";
            }
        } else {
            // 新しいパスワードをデータベースに保存できなかった場合
            echo "新しいパスワードを保存できませんでした。";
        }
        } else {
          // ユーザーが存在しない場合
          echo "ユーザー名とメールアドレスが一致するユーザーが存在しません。";
        }
        } else {
        // 不正なアクセス
        echo "不正なアクセスです。";
        }

// DB切断
mysqli_close($conn);

?>
