<?php
  $siteTitle = 'パスワード変更';
  require_once '../private/commonFunctions.php';
  require_once '../includes/header.php';
?>

  <section>
    <div>
      <form action="../private/passRemindSendFunction.php" method="post">
        <p>ご指定のメールアドレス宛にパスワード再発行用のURLと認証キーをお送り致します。</p>
        <div>
          <?php
            if(!empty($err_msg['common'])) echo $err_msg['common'];
          ?>
        </div>
        <label>
          Email
          <input type="text" name="email" value="<?php echo getFormData('email'); ?>">
        </label>
        <div>
          <?php
            if(!empty($err_msg['email'])) echo $err_msg['email'];
          ?>
        </div>
        <div>
          <input type="submit" value="送信する">
        </div>
      </form>
    </div>
    <a href="myPage.php">マイページに戻る</a>
  </section>

<?php
  require('../includes/footer.php');
?>
