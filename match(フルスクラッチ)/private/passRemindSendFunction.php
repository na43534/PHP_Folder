<?php

  require_once '../includes/config/sessionConfig.php';
  require_once '../includes/config/db.php';
  require_once '../includes/config/constants.php';
  require_once '../includes/debug/debug.php';
  require_once '../includes/debug/functions.php';
  require_once '../includes/private/commonFunction.php';

  // 認証
  // ユーザー名とメールアドレスの照合
  debugLogStart();
  debug('「「「「「「「「「「「「「「「「「「「');
  debug('パスワード変更メール');
  debug('「「「「「「「「「「「「「');

  $email = $_POST['email'];

  // 入力確認
  validRequired($email, 'email');

  if (empty($err_msg)) {

    debug('バリテーション処理に入ります');

    //emailの形式チェック
    validEmail($email, 'email');
    //emailの最大文字数チェック
    validMaxLen($email, 'email');
    //email重複チェック
    // validEmailDup($email);

    if(empty($err_msg)){

      // 新しいパスワードの生成
      $new_password = bin2hex(random_bytes(5));
      // パスワードの暗号化
      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

      debug('送信判定に入ります');

      try {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $sql = 'UPDATE users SET password = :pass WHERE email = :email AND delete_time = null';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":pass",$hashed_password, PDO::PARAM_STR);
        $result = $stmt->execute();
      } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
      }

      if ($result) {
        debug('送信処理に入ります');

        // パスワードをメールで送信
        $to = $email;
        $subject = "新しいパスワード";
        $message = "新しいパスワードは $new_password です。\n\nこのパスワードを使ってログインしてください。";
        // メアドのドメインは example.com についての記事
        // https://qiita.com/jnchito/items/198a2561a36c2c2ef5e3
        $headers = "From: no-reply@example.com";
        if (mail($to, $subject, $message, $headers)) {
          debug('メール送信に成功しました');
          // パスワードをメールで送信できた場合
          echo "新しいパスワードをメールで送信しました。";
        } else {
          debug('メール送信に失敗しました');
          // パスワードをメールで送信できなかった場合
          echo "パスワードをメールで送信できませんでした。";
        }
      }
    }

// DB切断
mysqli_close($conn);

?>
