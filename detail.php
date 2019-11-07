<?php
// 関数ファイルの読み込み
include('functions.php');

//var_dump($_POST);

// getで送信されたidを取得
$id = $_GET['id'];

//DB接続します
$pdo = connectToDb();

// exit('erro');

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM php03_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    // エラーのとき
    showSqlErrorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch();
    //var_dump($rs);
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
}
//categoryを取得する

//まずそれぞれのcategoryを変数にいれる
$MANGA = "";
$NOVEL = "";
$DESIGN = "";
$LIVING = "";

//switch($rs['category'])でカテゴリーを取得
//case 'MANGA'が取得できたらcheckedで表示
//なかったらbreakで他の取得に向かう 
switch ($rs['category']) {
    case 'MANGA':
        $MANGA = 'checked';
        break;
    case 'NOVEL':
        $NOVEL = 'checked';
        break;
    case 'DESIGN':
        $DESIGN = 'checked';
        break;
    case 'LIVING':
        $LIVING = 'checked';
        break;
}

$menu = menu();
?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>todo更新ページ</title>
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
                <h1 class="header-logo"><img src="" alt=""></h1>
            </div>
            <div class="header-logo"><img src="" alt="おきまり"></div>
            <a href="#menu" class="sp-menu-btn"><span>メニューを開く</span><span></span><span></span></a>
            <nav class="globalnavi">
                <ul class="globalnavi__inner">
                    <?= $menu ?>
                </ul>
            </nav>
        </header>

        <form action="#" method="post">
            <div class="form-group">
                <label for="name">書籍名</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $rs['name'] ?>" disabled="disabled">
            </div>


            <div class="form-group">
                <label for="url">書籍のurl</label>
                <input type="text" class="form-control" id="url" name="url" value="<?= $rs['url'] ?>" disabled="disabled">
            </div>

            <div class="form-group">
                <label for="comment">感想コメント</label>
                <textarea class="form-control" id="comment" rows="3" name="comment" disabled="disabled"><?= $rs['comment'] ?>"</textarea>
            </div>

            <div class="category">
                <ul>
                    <input type="hidden" name="cur_shift" value="$shift">
                    <li>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="category" class="custom-control-input" value="MANGA" <?= $MANGA ?> disabled="disabled">
                            <label class="custom-control-label" for="customRadio1" name="MANGA">漫画</label>
                        </div>
                    </li>
                    <li>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="category" class="custom-control-input" value="NOVEL" <?= $NOVEL ?> disabled="disabled">
                            <label class="custom-control-label" for="customRadio2" name="NOVEL">小説</label>
                        </div>
                    </li>
                    <li>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio3" name="category" class="custom-control-input" value="DESIGN" <?= $DESIGN ?> disabled="disabled">
                            <label class="custom-control-label" for="customRadio3" name="DESIGN">アート・デザイン</label>
                        </div>
                    </li>
                    <li>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio4" name="category" class="custom-control-input" value="LIVING" <?= $LIVING ?> disabled="disabled">
                            <label class="custom-control-label" for="customRadio4" name="LIVING">暮らし・健康・料理</label>
                        </div>
                    </li>
                </ul>
                <input type="hidden" name="id" value="<?= $rs['id'] ?>">
            </div>


            <!-- <div class="btnbox">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">登録するよ〜ん</button>
                </div>
            </div> -->
        </form>
    </body>
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

    </html>