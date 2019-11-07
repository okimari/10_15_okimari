<?php

//セッションスタート
session_start();

// 関数ファイルの読み込み
include('functions.php');

// ログイン状態のチェック
checkSessionId();

$menu = menu();


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン</title>
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
                <?= $menu ?>
            </ul>
        </nav>
    </header>

    <!-- <form method="post" action="user_login_act.php">
        <div class="form-group">
            <!-- <label for="lid">LoginID</label> -->
    <!-- <input type="text" class="form-control" id="lid" name="lid">
        </div>
        <div class="form-group">
            <!-- <label for="lpw">Pass</label> -->
    <!-- <input type="password" class="form-control" id="lpw" name="lpw">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>  -->

    <form name="Login" method="post" action="user_login_act.php">
        <div class="main">
            <div class="wrap-box">
                <p class="sign">Login</p>

                <input class="un" type="text" placeholder="loginID" id="lid" name="lid">
                <input class="pass" type="password" placeholder="Pass" id="lpw" name="lpw">

                <!-- <div class="checkboxbtn">
                    <input type="checkbox" name="information" placeholder="ログイン情報を保存する">ログイン情報を保存する
                </div> -->
                <input class="submit" type="submit" value="ログインする">
                <p class="forgot"><a href="#">パスワードを忘れた方はこちら</p>
                <p class="forgot"><a href="#">はじめてご利用の方</p>
            </div>
        </div>
    </form>


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