<?php
  include_once 'links.php';
  $link = new Links();
  $files='
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="'. $link->path('master_css') .'">
    <link rel="stylesheet" href="'. $link->path('bs_css') .'">
    <link rel="icon" type="image/png" sizes="32x32" href="'. $link->path('favicon_img') .'">
    <script src="'. $link->path('bs_js') .'"></script>
    <script src="https://kit.fontawesome.com/fa21dcf12d.js" crossorigin="anonymous"></script>
    ';
  echo $files;
?>
