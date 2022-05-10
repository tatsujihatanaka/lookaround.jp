<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>今日のパノラマ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<link href="css/normalize.css" rel="stylesheet">
		<link href="css/index.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
  </head>
  <body>
  <div class="container-back">
    <div class="container-main">
      <div class="section-header"><h1>今日のパノラマ</h1>
      </div>
    </div>
    <div class="container-panorama"></div>
    <div class="container-main">
<?php
$folder = "./images/thumbnail";
  print "<div class=\"section-thumbnail\">\n";
  print "<ul>\n";
  // サムネイル画像表示
  foreach ($data as $key => $value) {
    $fileName = $key . ".jpg";
    $filePath = $folder . "/" . $fileName;
    if (is_file($filePath)) {
      $pathInfo = pathinfo($filePath);
      if ($pathInfo["extension"] === "png"
      ||  $pathInfo["extension"] === "jpg") {
        print "<li>\n";
        print "<a href=\"" .  $key . "/\" target=\"_blank\">\n";
        print "<img class=\"lazy\" width=\"260\" height=\"145\" src=\"./images/common/loading.gif\" data-original=\"" . $filePath . "\">\n";
        print "</a>\n";
        print "</li>\n";
      }
    }
  }
  print "</ul>\n";
  print "</div>\n";
?>
    </div>
  </div>
  <script src="js/jquery/jquery-1.12.0.min.js"></script>
  <script src="js/jquery/jquery.lazyload.min.js"></script>
  <script>$("img.lazy").lazyload();</script>  
  </body>
</html>
