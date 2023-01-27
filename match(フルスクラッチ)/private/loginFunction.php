<?php

  ob_start();

  require_once '../includes/config/sessionConfig.php';
  require_once '../includes/config/db.php';
  require_once '../includes/config/constants.php';
  require_once '../includes/debug/debug.php';
  require_once '../includes/debug/functions.php';

  debugLogStart();
  debug('「「「「「「「「「「「「「「「「「「「');
  debug('ログインページ');
  debug('「「「「「「「「「「「「「');

  $email = $_POST['email'];
  $password = $_POST['password'];
  // $pass_save = (!empty($_POST['pass_save'])) ? true : false; //ショートハンド（略記法）という書き方

  // validRequired($email, 'email');
  // validRequired($password, 'password');

    if(empty($err_msg)){

      debug('ログイン処理に入ります');

      try {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $sql = 'SELECT email,password FROM users WHERE email = :email AND password = :pass AND delete_time = null';
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":pass", $password, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);





        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $stmt = $pdo->prepare('SELECT email,password  FROM users WHERE email = :email AND
        password = :password AND delete_time = true',
        array(':email' => $email,':pass' => $password,':create_date' => date('Y-m-d H:i:s')));
        $stmt->execute(array(':email' => $email,
        // password_hashは第二引数にPASSWORD_DEFAULTを指定することでハッシュ化もストレッチングも適宜やってくれるかもしれないので調べる。
        ':pass' => password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]),
        ':create_date' => date('Y-m-d H:i:s')));
        $user = $stmt->fetch();
        debug('クエリ結果の中身：'.print_r($user,true));

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
        $_SESSION['user_id'] = $user['id'];
        debug('セッション変数の中身：'.print_r($_SESSION,true));
        header('Location: ../public/timeline.php');
        exit;
      }else{
        debug('クエリの実行を確認して下さい。');
        $err_msg['common'] = MSG07;
        // todo:登録情報の破棄なども検討する。
        header('Location: ../public/index.php');
      }
    }elseif(empty($err_msg)){
      debug('バリテーションエラーです。');
      header('Location: ../public/index.php');
    }

?>
