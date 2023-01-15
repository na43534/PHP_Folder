<?php

  require_once '../includes/config/sessionConfig.php';
  require_once '../includes/config/db.php';
  require_once '../includes/config/contants.php';
  require_once '../includes/log/debug.php';

//ここからphpのコードスタート

$siteTitle = 'HOME';
require('../includes/header.php');
?>

  <div>
    <section>
      <a href="#">ホーム</a>
      <a href="./signUp.php">ユーザー登録</a>
      <a href="#">ログイン</a>
      <a href="#">パスワードを忘れた場合</a>
    </section>
  </div>

<?php
  require('../includes/footer.php');
?>
