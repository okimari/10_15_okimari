<?php
//1. DB接続
include('functions.php');

$dbn = 'mysql:dbname=gsacfd04_15;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
}

//2. データ表示SQL作成
$sql = 'SELECT * FROM php03_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
//executeで実行


$view = '';
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<li>';
        $view .= ' <img src="' . $result['image'] . '" alt="画像" heght="100px">';
        $view .= '<dl>';
        $view .= '<dt>' . $result['name'] . '</dt>'; //書籍の名前
        $view .= '<td>' . $result['url'] . '</td>'; //書籍のURL
        $view .= '<td>' . $result['comment'] . '</td>'; //本のコメント
        //if (time() - strtotime($result['indate']) < (3600 * 24)) {
        //echo "new";
        //}
        //time();
        $view .= '<dd>';
        $view .= '<p class="category02">' . $result['category'] . '</p>'; //カテゴリーだけlist.jsで呼び出すのでclss名追加
        $view .= '<p class="indate">' . $result['indate'] . '</p>'; //日時 
        $view .= '<dd>';
        $view .= '<td><a href="detail.php?id=' . $result['id'] . '" class="badge badge-primary">Edit</a></td>'; //日時
        $view .= '<td><a href="delete.php?id=' . $result['id'] . '" class="badge badge-danger">Delete</a></td>'; //日時
        $view .= '</dl>';
        $view .= '</li>';
    }
}
$menu = menu();

?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>記事一覧</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/colorbox.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header class="l-header">
        <div class="logo">
            <h1 class="header-logo"><img src="logo.png" alt=""></h1>
        </div>
        <div class="header-logo"><img src="" alt=""></div>
        <a href="#menu" class="sp-menu-btn"><span>メニューを開く</span><span></span><span></span></a>
        <nav class="globalnavi">
            <ul class="globalnavi__inner">
                <?= $menu ?>
            </ul>
        </nav>
    </header>

    <!-- <section class="blog">
        <div class="wrap_blog">
            <div id="list_boxs">
                <p>カテゴリーで検索してね</p>
                <p>[MANGA]・[NOVEL]・[DESIGN]・[LIVING]</p>
                <input id="custom-search-field" placeholder="Search name" />
                <button class="sort" data-sort="category">検索</button> -->

    <!-- ここにDBから取得したデータを表示しよう -->
    <table class="table table-striped">
        <div class="blog_list">
            <ul>
                <?= $view ?>
            </ul>
        </div>
    </table>
    </div>
    </div>
    </section>


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

    <!-- list.jsの指定 -->
    <script>
        var options = {
            //引き出すカテゴリー指定
            valueNames: ['category']
        };
        //引き出す場所
        var userList = new List('list_boxs', options);

        //
        $('#custom-search-field').on('keyup', function() {
            var searchString = $(this).val()
            userList.search(searchString, {
                columns: ['category']
            })
        })
    </script>


    <script>
        $(function() {
            var distance = 3 * 86400000; // 3日間のミリ秒数で求める
            var today = new Date(); // 現在の年月日のDateオブジェクトを生成
            var baseTime = today.getTime(); // 現在の年月日のミリ秒数を求める
            $('.blog_list ul li dl dd .category').each(function() {
                var textVal = $(this).text(); // dtに記述された年月日を取得
                var dateArr = textVal.split('-'); // 年月日に分けて配列に入れる
            });
        });
    </script>
</body>

</html>