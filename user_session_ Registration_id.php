<?php
//必ずsession_startは最初に記述
session_start();

//現在のセッションIDを取得
$old_id = (session_id());

//新しいセッションIDを発行（前のSESSION IDは無効）
session_regenerate_id(true);

//新しいセッションIDを取得
$new_id = session_id();

//旧セッションIDと新セッションIDを表示
// var_dump($old_id);
// var_dump($new_id);
echo 'old: ' . $old_id . 'new;' . $new_id;
