<?php

//セッションスタート
session_start();

// 関数ファイルの読み込み
include('functions.php');

// ログイン状態のチェック
checkSessionId();

$kanri_menu = kanri_menu();


// getで送信されたidを取得
if (!isset($_GET['id'])) {
    exit("Error");
}

// getで送信されたidを取得
$id = $_GET['id'];

//DB接続します
$pdo = connectToDb();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT *FROM user_table WHERE id= :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status == false) {
    // エラーのとき
    showSqlErrorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch();
    // var_dump($rs);
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
    // var_dump()で見てみよう
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー情報更新ページ</title>
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

    <form method="post" action="user_update.php">
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?= $rs['name'] ?>">
        </div>
        <div class="form-group">
            <label for="lid">ログインID</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="lid" name="lid" value="<?= $rs['lid'] ?>">
        </div>
        <div class="form-group">
            <label for="lpw">パスワード</label>
            <!-- 受け取った値をvaluesに挿入しよう -->
            <input type="text" class="form-control" id="lpw" name="lpw" value="<?= $rs['lpw'] ?>">
        </div>
        <div class="form-group">
            <label for="kanri_flg">0:一般・1:管理者</label>
            <!-- 受け取った値をvaluesに挿入しよう -->
            <select id="kanri_flg" class="form-control" name="kanri_flg" value="<?= $rs['kanri_flg'] ?>">
                <option <?= $rs['kanri_flg'] != '0' ?: 'selected' ?> value="0">一般</option>
                <option <?= $rs['kanri_flg'] != '1' ?: 'selected' ?> value="1">管理者</option>
            </select>
        </div>
        <div class="form-group">
            <label for="life_flg">0:アクティブ・1:非アクティブ</label>
            <!-- 受け取った値をvaluesに挿入しよう -->
            <select id="life_flg" class="form-control" name="life_flg" value="<?= $rs['life_flg'] ?>">
                <option <?= $rs['life_flg'] != '0' ?: 'selected' ?> value="0">アクティブ</option>
                <option <?= $rs['life_flg'] != '1' ?: 'selected' ?> value="1">非アクティブ</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- idは変えたくない = ユーザーから見えないようにする-->
        <input type="hidden" name="id" value="<?= $id ?>">
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