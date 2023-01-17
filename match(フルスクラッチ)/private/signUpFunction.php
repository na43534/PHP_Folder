<?php

  require_once '../includes/config/sessionConfig.php';
  require_once '../includes/config/db.php';
  require_once '../includes/config/constants.php';
  require_once '../includes/debug/debug.php';

  debugLogStart();
  debug('「「「「「「「「「「「「「「「「「「「');
  debug('アカウント作成ページ');
  debug('「「「「「「「「「「「「「');

  $email = $_POST['email'];
  $password = $_POST['password'];

  debug('バリテーション処理に入ります');

  // debug('');
  // // ユーザーが見つからなかった場合
  // if (!$user) {
  //   $_SESSION['signUp_error'] = MSG09;
  //   header('Location: ../index.php');
  //   exit;
  // }

  // // パスワードが一致しなければ、ログイン失敗
  // if (!password_verify($password, $user['password'])) {
  //     $_SESSION['signUp_error'] = MSG09;
  //     header('Location: ../index.php');
  //     exit;
  // }

  debug('送信判定に入ります');
  if(!empty($email) && !empty($password)){
    debug('接続・登録処理に入ります');
    try {
      $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $stmt = $pdo->prepare('INSERT INTO users  (email,password,create_date) VALUES(:email,:pass,:create_date)',
      array(':email' => $email,':pass' => $password,':create_date' => date('Y-m-d H:i:s')));
      $stmt->execute(array(':email' => $email,':pass' => $password,':create_date' => date('Y-m-d H:i:s')));
      $user = $stmt->fetch();
    } catch (Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
    }
  }

  debug('登録が完了しました。');

  // $_SESSION['logged_in'] = true;
  // $_SESSION['user_id'] = $user['id'];

  // debug('接続に成功しました');

  header('Location: ../public/timeline.php');
  exit;

?>
