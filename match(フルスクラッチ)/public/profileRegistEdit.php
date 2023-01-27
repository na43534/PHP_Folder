<!-- <?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　プロフィール編集ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//================================
// 画面処理
//================================
// DBからユーザーデータを取得
$dbFormData = getUser($_SESSION['user_id']);

debug('取得したユーザー情報：'.print_r($dbFormData,true));

// post送信されていた場合
if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST,true));
  debug('FILE情報：'.print_r($_FILES,true));

  //変数にユーザー情報を代入
  $username = $_POST['username'];
  $tel = $_POST['tel'];
  $zip = (!empty($_POST['zip'])) ? $_POST['zip'] : 0; //後続のバリデーションにひっかかるため、空で送信されてきたら0を入れる
  $addr = $_POST['addr'];
  $age = $_POST['age'];
  $email = $_POST['email'];
  //画像をアップロードし、パスを格納
  $pic = ( !empty($_FILES['pic']['name']) ) ? uploadImg($_FILES['pic'],'pic') : '';
  // 画像をPOSTしてない（登録していない）が既にDBに登録されている場合、DBのパスを入れる（POSTには反映されないので）
  $pic = ( empty($pic) && !empty($dbFormData['pic']) ) ? $dbFormData['pic'] : $pic;

  //DBの情報と入力情報が異なる場合にバリデーションを行う
  if($dbFormData['username'] !== $username){
    //名前の最大文字数チェック
    validMaxLen($username, 'username');
  }
  if($dbFormData['tel'] !== $tel){
    //TEL形式チェック
    validTel($tel, 'tel');
  }
  if($dbFormData['addr'] !== $addr){
    //住所の最大文字数チェック
    validMaxLen($addr, 'addr');
  }
  if( (int)$dbFormData['zip'] !== $zip){ //DBデータをint型にキャスト（型変換）して比較
    //郵便番号形式チェック
    validZip($zip, 'zip');
  }
  if($dbFormData['age'] !== $age){
    //年齢の最大文字数チェック
    validMaxLen($age, 'age');
    //年齢の半角数字チェック
    validNumber($age, 'age');
  }
  if($dbFormData['email'] !== $email){
    //emailの最大文字数チェック
    validMaxLen($email, 'email');
    if(empty($err_msg['email'])){
      //emailの重複チェック
      validEmailDup($email);
    }
    //emailの形式チェック
    validEmail($email, 'email');
    //emailの未入力チェック
    validRequired($email, 'email');
  }

  if(empty($err_msg)){
    debug('バリデーションOKです。');

    //例外処理
    try {
      // DBへ接続
      $dbh = dbConnect();
      // SQL文作成
      $sql = 'UPDATE users  SET username = :u_name, tel = :tel, zip = :zip, addr = :addr, age = :age, email = :email, pic = :pic WHERE id = :u_id';
      $data = array(':u_name' => $username , ':tel' => $tel, ':zip' => $zip, ':addr' => $addr, ':age' => $age, ':email' => $email, ':pic' => $pic, ':u_id' => $dbFormData['id']);
      // クエリ実行
      $stmt = queryPost($dbh, $sql, $data);

      // クエリ成功の場合
      if($stmt){
        $_SESSION['msg_success'] = SUC02;
        debug('マイページへ遷移します。');
        header("Location:mypage.php"); //マイページへ
      }

    } catch (Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
      $err_msg['common'] = MSG07;
    }
  }
}
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?> -->
