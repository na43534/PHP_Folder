<?php

  require_once '../includes/config/sessionConfig.php';
  require_once '../includes/config/db.php';
  require_once '../includes/config/constants.php';
  require_once '../includes/debug/debug.php';
  require_once '../includes/debug/functions.php';

  debugLogStart();
  debug('「「「「「「「「「「「「「「「「「「「');
  debug('アカウント作成処理');
  debug('「「「「「「「「「「「「「');

  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_re = $_POST['password_re'];

  validRequired($email, 'email');
  validRequired($password, 'password');
  validRequired($password_re, 'password_re');

  if(empty($err_msg)){

    debug('バリテーション処理に入ります');

    //emailの形式チェック
    validEmail($email, 'email');
    //emailの最大文字数チェック
    validMaxLen($email, 'email');
    //email重複チェック
    // validEmailDup($email);

    //パスワードの半角英数字チェック
    validHalf($password, 'password');
    //パスワードの最大文字数チェック
    validMaxLen($password, 'password');
    //パスワードの最小文字数チェック
    validMinLen($password, 'password');

    //パスワード（再入力）の最大文字数チェック
    validMaxLen($password_re, 'password_re');
    //パスワード（再入力）の最小文字数チェック
    validMinLen($password_re, 'password_re');



    if(empty($err_msg)){

      debug('送信判定に入ります');

      //パスワードとパスワード再入力が合っているかチェック
      validMatch($password, $password_re, 'password_re');

      if(empty($err_msg)){

        debug('接続・登録処理に入ります');

        try {
          $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
          $sql = 'INSERT INTO users (email,password,create_date) VALUES(:email,:pass,:create_date)';
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(":email", $email, PDO::PARAM_STR);
          $stmt->bindValue(":pass", $password, PDO::PARAM_STR);
          $stmt->bindValue(":create_date", date('Y-m-d H:i:s'), PDO::PARAM_STR);
          $result = $stmt->execute();
        } catch (Exception $e) {
          error_log('エラー発生:' . $e->getMessage());
        }

        // クエリ成功の場合
        if($result){
          debug('セッション情報を更新します。');
          //ログイン有効期限（デフォルトを１時間とする）
          $sesLimit = 60*60;
          // 最終ログイン日時を現在日時に
          $_SESSION['login_date'] = time();
          $_SESSION['login_limit'] = $sesLimit;
          // ユーザーIDを格納
          $_SESSION['user_id'] = $pdo->lastInsertId();
          debug('セッション変数の中身：'.print_r($_SESSION,true));
          header('Location: ../public/timeline.php');
          exit;
        }else{
          debug('クエリの実行を確認して下さい。');
          $err_msg['common'] = MSG07;
          // todo:登録情報の破棄なども検討する。
          header('Location: ../public/index.php');
        }
      }


    }elseif(empty($err_msg)){
      debug('バリテーションエラーです。');
      header('Location: ../public/index.php');
    }
  }

?>
