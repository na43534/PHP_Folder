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
        debug('クエリ成功。');

        //メールを送信
        $from = 'Naruse@gmail.com';
        $to = 'zhuneiliusheng@gmail.com';
        $subject = '【パスワード再発行完了】｜MATCH';
        //EOTはEndOfFileの略。ABCでもなんでもいい。先頭の<<<の後の文字列と合わせること。最後のEOTの前後に空白など何も入れてはいけない。
        //EOT内の半角空白も全てそのまま半角空白として扱われるのでインデントはしないこと
        $comment = <<<EOT
          本メールアドレス宛にパスワードの再発行を致しました。
          下記のURLにて再発行パスワードをご入力頂き、ログインください。

          ログインページ：http://localhost:8888/phpFolder/match(%e3%83%95%e3%83%ab%e3%82%b9%e3%82%af%e3%83%a9%e3%83%83%e3%83%81)/public/login.php
          再発行パスワード：{$hashed_password}
          ※ログイン後、パスワードのご変更をお願い致します
        EOT;

        if (sendMail($from, $to, $subject, $comment)) {
          //セッション削除
          session_unset();
          debug('セッション変数の中身：'.print_r($_SESSION,true));
          header("Location:login.php");

        } else {
          debug('メール送信に失敗しました');
          header("Location:passRemindSend.php");
        }
      }
    }
  }

// DB切断
mysqli_close($conn);

?>
