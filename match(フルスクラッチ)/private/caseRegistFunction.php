<?php

  require_once '../includes/config/sessionConfig.php';
  require_once '../includes/config/db.php';
  require_once '../includes/config/constants.php';
  require_once '../includes/debug/debug.php';
  require_once '../includes/debug/functions.php';

  debugLogStart();
  debug('「「「「「「「「「「「「「「「「「「「');
  debug('案件登録処理');
  debug('「「「「「「「「「「「「「');

  $case_title = $_POST['caseTitle'];
  $case_type = $_POST['caseType'];
  $amount_of_money = $_POST['amountOfMoney'];
  $case_about = $_POST['caseAbout'];

  validRequired($case_title, 'caseTitle');
  validRequired($case_type, 'caseType');
  validRequired($amount_of_money, 'amountOfMoney');
  validRequired($case_about, 'caseAbout');

  if(empty($err_msg)){

    debug('バリテーション処理に入ります');

    //memo:のちに追加予定
    //一旦省略

    if(empty($err_msg)){

      debug('送信判定に入ります');

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
