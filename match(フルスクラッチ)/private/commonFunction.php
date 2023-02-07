<?php

  // フォーム側の表示用
  // memo: 以下のサイトを参考に配列情報を担保することを検討する。
  // https://qiita.com/taruhachi/items/2ecf21d450f099054c61
  // https://www.techscore.com/tech/DesignPattern/


  global $err_msg;

  // サニタイズ
  function sanitize($str){
    // ENT_QUOTES・・・シングルクオートとダブルクオート両方変換する。
    return htmlspecialchars($str,ENT_QUOTES);
  }

  // フォーム入力保持
  function getFormData($str, $flg = false){
    if($flg){
      $method = $_GET;
    }else{
      $method = $_POST;
    }
    global $dbFormData;
    // ユーザーデータがある場合
    if(!empty($dbFormData)){
      //フォームのエラーがある場合
      if(!empty($err_msg[$str])){
        //POSTにデータがある場合
        if(isset($method[$str])){
          return sanitize($method[$str]);
        }else{
          //ない場合（基本ありえない）はDBの情報を表示
          return sanitize($dbFormData[$str]);
        }
      }else{
        //POSTにデータがあり、DBの情報と違う場合
        if(isset($method[$str]) && $method[$str] !== $dbFormData[$str]){
          return sanitize($method[$str]);
        }else{
          return sanitize($dbFormData[$str]);
        }
      }
    }else{
      if(isset($method[$str])){
        return sanitize($method[$str]);
      }
    }
  }

?>
