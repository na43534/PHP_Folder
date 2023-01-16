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
          <!-- ここエラーメッセージ差し込む。セッションで管理 -->
        </div>
        <br>
        <!-- <label for="password">Password:</label> -->
        <input type="password" id="password" name="password">
        <div class="#">
          <!-- ここエラーメッセージ差し込む。セッションで管理 -->
        </div>
        <br>
        <input type="submit" value="SignUp">

      </form>

    </section>
  </div>

<?php
  require('../includes/footer.php');
?>
