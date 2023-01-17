<?
  $siteTitle = 'SignUp';
  require('../includes/header.php');
?>

  <div>
    <section>
      <a href="./index.php">ホームへ戻る</a>

      <form action="../private/signUpFunction.php" method="post">

        <!-- <label for="email">Email:</label> -->
        <input type="email" id="email" name="email">
        <div class="#">
          <?php
            if(!empty($err_msg['email'])) echo $err_msg['email'];
          ?>
        </div>
        <br>
        <input type="password" id="password" name="password">
        <div class="#">
          <?php
            if(!empty($err_msg['password'])) echo $err_msg['password'];
          ?>
        </div>
        <input type="password" id="password_re" name="password_re">
        <br>
        <div class="#">
          <?php
            if(!empty($err_msg['password_re'])) echo $err_msg['password_re'];
          ?>
        </div>
        <input type="submit" value="SignUp">

      </form>

    </section>
  </div>

<?php
  require('../includes/footer.php');
?>
