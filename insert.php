<?php
// exit('erro');
var_dump($_POST);
// 入力チェック
// セッションのスタート
session_start();
//1. DB接続
include('functions.php');

// ログイン状態のチェック
checkSessionId();



if (
    !isset($_POST['name']) || $_POST['name'] == '' ||
    !isset($_POST['url']) || $_POST['url'] == '' ||
    !isset($_POST['comment']) || $_POST['comment'] == '' ||
    !isset($_POST['category']) || $_POST['category'] == ''
) {
    exit('ParamError');
}

// exit('erro');
// var_dump($_POST);


//categoryを取得する
if (isset($_POST['category'])) {
    $category = $_POST['category'];
    echo 'カテゴリー：' . $category . '<br>';
} else {
    echo 'カテゴリーが選択されてなーい<br>';
}


//POSTデータ取得
//まず変数を指定
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];
$category = $_POST['category'];
$indate = $_POST['indate'];
$upfile = $_POST['upfile'];



// Fileアップロードチェック
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
    $uploadedFileName = $_FILES['upfile']['name'];
    $tempPathName = $_FILES['upfile']['tmp_name'];
    var_dump($_POST);
    $fileDirectoryPath = 'upload/';
    // var_dump('ok');
    // exit;
    $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
    $uniqueName = date('YmdHis') . md5(session_id()) . "." . $extension;

    $fileNameToSave = $fileDirectoryPath . $uniqueName;

    // FileUpload終了
    if (is_uploaded_file($tempPathName)) {
        if (move_uploaded_file($tempPathName, $fileNameToSave)) {
            chmod($fileNameToSave, 0644);
            $img = '<img src="' . $fileNameToSave . '" >';
        }
    } else {
        exit('Error:ファイルのアップロードに失敗しました');
    }
} else {
    // ファイルをアップしていないときの処理
    $img = '画像が送信されていません';
}


//DB接続
$dbn = 'mysql:dbname=gsacfd04_15;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
}



//データ登録SQL登録

$sql = 'INSERT INTO php03_table(id, name, url, comment,category,indate,image)VALUES(NULL, :a1, :a2, :a3, :a4,sysdate(), :image)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $category, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image', $fileNameToSave, PDO::PARAM_STR);
$status = $stmt->execute();


if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    header('Location: select.php');
}
