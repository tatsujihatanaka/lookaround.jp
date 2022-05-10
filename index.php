<?php
/**

lookaround.jp コントローラー

*/
ini_set( 'display_errors', 1 );
// var_dump($_SERVER);
//------------------------------------------------------------------------------
// PATH INFO
//------------------------------------------------------------------------------
// URLのルートを取得
// "lookaround.jp.4"
$path_root = dirname($_SERVER["SCRIPT_NAME"]);
$path_root = trim($path_root);
$path_root = trim($path_root, "/");
// baseタグの値を編集
// "http://localhost/lookaround.jp.4/"
// $base_path  = $_SERVER["REQUEST_SCHEME"];
$base_path  = "http";
$base_path .= "://";
$base_path .= $_SERVER["HTTP_HOST"];
// $base_path .= dirname($_SERVER["SCRIPT_NAME"]);
if ($path_root != "") {
  $base_path .= "/" . $path_root;
}
$base_path .= "/";
// URIを取得
// "lookaround.jp.4/201aa6011202"
$request_uri = $_SERVER["REQUEST_URI"];
$request_uri = trim($request_uri);
$request_uri = trim($request_uri, "/");
// PATH INFOを取得
// URIからルート以降を切り出し
$path_info = mb_substr($request_uri, mb_strlen($path_root));
$path_info = trim($path_info);
$path_info = trim($path_info, "/");
// PATH INFOをスラッシュで分割
$path = explode("/", $path_info);
//------------------------------------------------------------------------------
// 画面ごとの処理
//------------------------------------------------------------------------------
// データを読み込む
require "data/data.php";
// 画像フォルダのパスを定義
$folder = "./images/equirectangular";
// PATH INFOでviewを切り替え
if ($path[0] === '') {
  // トップページ
  require "views/index.php";
} else {
  // var_dump($_SERVER);
  // print "<div>path_root:"   . $path_root . "</div>\n";
  // print "<div>base_path:"   . $base_path . "</div>\n";
  // print "<div>request_uri:"   . $request_uri . "</div>\n";
  if (!array_key_exists($path[0], $data)) {
    // print "<div>base_path:"   . $base_path . "</div>\n";
    header("Location: " . $base_path);
    exit();
  } else {
    // パノラマ
    $title    = $data[$path[0]]["title"];
    $phiStart = $data[$path[0]]["phiStart"];
    $image    = $data[$path[0]]["image"];
    $image = $folder . "/" . $image . ".jpg";
    require "views/image.php";
  }
}
