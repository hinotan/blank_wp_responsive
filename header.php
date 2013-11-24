<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>
    <?php
      if ( is_front_page() ) { bloginfo('name'); echo ' - '; bloginfo('description'); }
      elseif ( is_category() ) { bloginfo('name'); echo ' - '; single_cat_title(); }
      elseif (is_single() ) { bloginfo('name'); echo ' - '; single_post_title(); }
      elseif (is_page() ) { bloginfo('name'); echo ' - '; single_post_title(); }
      else { bloginfo('name'); echo ' - '; wp_title('',true); }
    ?>
  </title>
  <meta name="author" content="" />
  <meta name="designer" content="UPRISE - uprise.co.nz" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- ::: CSS :::::::::: -->
  <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css" type="text/css" />
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/print.css" type="text/css" media="print"/>
  <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/iefix.css" type="text/css" media="screen" /><![endif]-->


<!-- ::: Favicons :::::::::: -->
  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/assets/favicon.ico" />
  <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/assets/apple-touch-icon.png"/>

<!-- ::: iOS ::::::::: -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- ::: Analytics :::::::::: -->


  <?php wp_deregister_script('jquery'); ?>
  <?php wp_head(); ?>
</head>
<body>
<!--[if lt IE 7]>
  <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>

  <p class="chromeframe">
  您的浏览器版本过低，您可能错过了许多互联网上的精彩内容。请<a href="http://windows.microsoft.com/zh-CN/internet-explorer/downloads/ie">升级IE</a>或<a href="http://www.google.com/chromeframe/?redirect=true&prefersystemlevel=true&hl=zh-CN">使用谷歌浏览器内嵌框架</a>来改善您的上网体验。
  </p>
<![endif]-->
<noscript>
<div class="no-js">
  Your browser does not support JavaScript! <br>This website is best viewed with Javascript on. Please enable JavaScript in your browser settings or update your browser.
  您的浏览器不支持JavaScript，将无法正常浏览本网站。<br>请在浏览器设置中打开JavaScript支持，或升级您的浏览器。
</div>
</noscript>

<?php
wp_nav_menu( array(
  'menu'            => 'Main Menu',
  'container'       => 'nav',
  'container_class' => 'mobile',
  'container_id'    => 'mobile-nav',
  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
) );
?>

<div id="body-wrapper">
