<?php

// セッションのスタート
session_start();
//1. DB接続
include('functions.php');

// ログイン状態のチェック
checkSessionId();

$kanri_menu = kanri_menu();

$pdo = connectToDb();

//データ表示SQL作成
$sql = 'SELECT * FROM user_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
//データ表示


$view = '';
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $view .= '<table class="table" style="table-layout: fixed; overflow-wrap : break-word;">';
        $view .= '<thead class="thead-light">';
        $view .= '<tr>';
        $view .= '<th>' . $result['id'] . '</t>';
        $view .= '<a href="user_detail.php?id=' . $result['id'] . '" class="badge badge-primary">Edit</a>';
        $view .= '<a href="user_delete.php?id=' . $result['id'] . '" class="badge badge-danger">Delete</a>';
        $view .= '<td>' . $result['name'] . '</td>';
        $view .= '<td>' . $result['lid']  . '</td>';
        $view .= '<td>' . $result['lpw']  . '</td>';
        $view .= '<td>' . $result['kanri_flg']  . '</td>';
        $view .= '<td>' . $result['life_flg']  . '</td>';
        $view .= '</tr>';
        $view .= '</tbody>';
        $view .= '</table>';
    }
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/colorbox.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header class="l-header">
        <div class="logo">
            <h1 class="header-logo"><img src="images/logo.png" alt=""></h1>
        </div>
        <div class="header-logo"><img src="" alt=""></div>
        <a href="#menu" class="sp-menu-btn"><span>メニューを開く</span><span></span><span></span></a>
        <nav class="globalnavi">
            <ul class="globalnavi__inner">
                <?= $kanri_menu ?>
            </ul>
        </nav>
    </header>
    <div>
        <ul class="table">
            <table class="table" style="table-layout: fixed;">
                <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>ユーザー名</th>
                        <th>ログインID</th>
                        <th>パスワード</th>
                        <th>0:一般<br>1:管理者</th>
                        <th>0:アクティブ<br>1:非アクティブ</th>
                    </tr>
                </thead>
            </table>
            <?= $view ?>
        </ul>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/list.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/home-movie.js"></script>
    <script src="js/jquery-ui-datepicker.js"></script>
</body>

</html>