<?php

  $siteTitle = '案件登録';
  require_once '../private/commonFunctions.php';
  require('../includes/header.php');

?>

<section>
    <div>
      <form action="../private/caseRegistFunction.php" method="post">
        <p>案件登録画面</p>
        <div>
          <?php
            if(!empty($err_msg['common'])) echo $err_msg['common'];
          ?>
        </div>

        <label>
          タイトル
          <input type="text" name="caseTitle" value="<?php echo getFormData('caseTitle'); ?>">
        </label>
        <div>
          <?php
            if(!empty($err_msg['caseTitle'])) echo $err_msg['caseTitle'];
          ?>
        </div>

        <!-- 選択制にする -->
        <label>
          案件種別
          <input type="text" name="caseType" value="<?php echo getFormData('caseType'); ?>">
        </label>
        <div>
          <?php
            if(!empty($err_msg['caseType'])) echo $err_msg['caseType'];
          ?>
        </div>

        <label>
          金額
          <input type="text" name="amountOfMoney" value="<?php echo getFormData('amountOfMoney'); ?>">
        </label>
        <div>
          <?php
            if(!empty($err_msg['amountOfMoney'])) echo $err_msg['amountOfMoney'];
          ?>
        </div>

        <label>
          内容
          <input type="text" name="caseAbout" value="<?php echo getFormData('caseAbout'); ?>">
        </label>
        <div>
          <?php
            if(!empty($err_msg['caseAbout'])) echo $err_msg['caseAbout'];
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
