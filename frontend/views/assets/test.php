<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
echo '<h3>模型场景测试</h3>';
echo '<form name="" method="post" action="#">';
echo '<label for="author">Author: <input type="text" name="author" id="author" value=""/></label><br/>';
echo '<label for="title">Title: <input type="text" name="title" id="title" value=""/></label><br/>';
echo '<label for="content">Content: <input type="text" name="content" id="content" value=""/></label><br/>';
echo '<label><input type="radio" name="scenario" value="default" checked/>Default</label>';
echo '<label><input type="radio" name="scenario" value="test"/>Test</label><br/>';
echo '<input type="submit" value="Save"/>';
echo '<input type="reset" value="Reset"/>';
echo '<input type="hidden" name="'.\Yii::$app->request->csrfParam.'" value="'.\Yii::$app->request->getCsrfToken().'"/>';
echo '</form>';
?>
</body>
</html>