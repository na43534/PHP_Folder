<?php
// セッションを削除（ログアウトする）
session_destroy();
// ログインページへ
header("Location:index.php");
