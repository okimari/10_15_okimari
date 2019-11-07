<?php

//セッションスタート
session_start();

// 関数ファイルの読み込み
include('functions.php');
// ログイン状態のチェック
checkSessionId();
$kanri_menu = kanri_menu();

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BOOK</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/colorbox.css">
    <link rel="stylesheet" href="css/style.css">
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


    <div class="box">
        <div class="wrap_box">

            <form action="insert.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>


                <div class="form-group">
                    <label for="url">所属チーム</label>
                    <input type="text" class="form-control" id="url" name="url">
                </div>

                <div class="form-group">
                    <label for="comment">得意なこと・今後の目標</label>
                    <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                </div>

                <div class="form-group">
                    <label for="deadline">登録日時</label>
                    <input type="date" class="form-control" id="indate" name="indate">
                </div>


                <div class="category">
                    <ul>
                        <li>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="category" class="custom-control-input" value="MANGA">
                                <label class="custom-control-label" for="customRadio1">WEB</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="category" class="custom-control-input" value="NOVEL">
                                <label class="custom-control-label" for="customRadio2">DESIGN</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="category" class="custom-control-input" value="DESIGN">
                                <label class="custom-control-label" for="customRadio3">JavaScript</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="category" class="custom-control-input" value="LIVING">
                                <label class="custom-control-label" for="customRadio4">php</label>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <label for="upfile">Image</label>
                                <!-- inputを追加 -->
                                <input type="file" id="upfile" name="upfile" accept="image/*" capture="camera">
                            </div>
                        </li>
                    </ul>
                </div>


                <div class="btnbox">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- <div id="popup" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
    問い合わせますか？<br />
    <button id="ok" onclick="okfunc()">OK</button>
    <button id="no" onclick="nofunc()">キャンセル</button>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>
    function confirm_test() { // 問い合わせるボタンをクリックした場合
      document.getElementById('popup').style.display = 'block';
      return false;
    }

    function okfunc() { // OKをクリックした場合
      document.contactform.submit().style.display = 'none';
    }

    function nofunc() { // キャンセルをクリックした場合
      document.getElementById('popup').style.display = 'none';
    }
  </script> -->



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