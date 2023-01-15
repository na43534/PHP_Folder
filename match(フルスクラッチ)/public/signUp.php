<?php

  require_once '../includes/config/sessionConfig.php';
  require_once '../includes/config/db.php';
  require_once '../includes/config/contants.php';
  require_once '../includes/log/debug.php';

  $email = $_POST['email'];
  $password = $_POST['password'];

  if(!empty($email) && !empty($password)){
    try {
      $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
      $stmt->execute([$email]);
      $user = $stmt->fetch();
    } catch (Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
    }
  }

  // ユーザーが見つからなかった場合
  if (!$user) {
    $_SESSION['login_error'] = MSG09;
    header('Location: ../index.php');
    exit;
  }

  // パスワードが一致しなければ、ログイン失敗
  if (!password_verify($password, $user['password'])) {
      $_SESSION['login_error'] = 'Invalid Email or Password';
      header('Location: ../index.php');
      exit;
  }

  $_SESSION['logged_in'] = true;
  $_SESSION['user_id'] = $user['id'];

  header('Location: ../timeline.php');
  exit;

  $siteTitle = 'SignUp';
  require('../includes/header.php');

?>

  <div>
    <section>
      <a href="./index.php">ホームへ戻る</a>
      <form action="" method="post" class="#">

        <h2 class="title">ユーザー登録</h2>

        <div class="#">
          共通エラーの出力
        </div>

        <label class="#">
          Email
          <!-- input差し込み予定 -->
        </label>

        <div class="#">
          <!-- ここエラーメッセージ差し込む。セッションで管理 -->
        </div>

        <div class="#">
          <input type="submit" class="#" value="登録する">
        </div>

      </form>
    </section>
  </div>

<?php
  require('../includes/footer.php');
?>
