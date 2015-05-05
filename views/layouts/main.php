<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <meta name='loginza-verification' content='907fe37b789c86c08455f1f014b145f0' />
  <meta charset="utf-8">
  <title><?php echo Core::getConfig('title', 'Test app'); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo Core::app()->request()->baseUrl(); ?>/css/base.css?v=1"/>
  <link rel="stylesheet" type="text/css" href="<?php echo Core::app()->request()->baseUrl(); ?>/css/main.css?v=1"/>
  <?php /*
  <meta name="keywords" content="">
  <meta name="description" content="">
 */
  ?>
  <meta name="author" content=""/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<div class="header">
  <div class="container">
    <?php require_once 'header.php'; ?>
  </div>
</div>

<div id="main" class="container">
  <div id="content" class="content">
    <?php
    /** @var $content string */
    echo $content;
    ?>
  </div>
</div>

<div class="footer">
  <div class="container">
    <?php require_once 'footer.php'; ?>
  </div>
</div>

</body>
</html>
