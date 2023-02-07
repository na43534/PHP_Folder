<?
  $siteTitle = 'Login';
  require('../includes/header.php');
?>

  <div>
    <section>
      <a href="./index.php">ホームへ戻る</a>
      <div>login</div>
      <form action="../private/loginFunction.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"
        value="<?php echo getFormData('email'); ?>">
        <div class="#">
          <?php
            if(!empty($err_msg['email'])) echo $err_msg['email'];
          ?>
        </div>
        <br>
        <input type="password" id="password" name="password"
        value="<?php echo getFormData('password'); ?>">
        <div class="#">
          <?php
            if(!empty($err_msg['password'])) echo $err_msg['password'];
          ?>
        </div>
        <!-- 入力情報の保持処理を追加 -->
        <input type="submit" name="Login">

        <label>
          <input type="checkbox" name="pass_save">次回ログインを省略する
        </label>
        パスワードを忘れた方は<a href="passRemindSend.php">コチラ</a>
      </form>
    </section>
  </div>

<?php
  require('../includes/footer.php');
?>
