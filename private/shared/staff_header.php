<?php
  if(!isset($page_title)) { $page_title = 'Kinmount Fair Trailer Park'; }
 ?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <title><?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/styles.css'); ?>" />
  </head>

  <body>
    <div class="grid-container">
      <div class="logo">
        <img class="logo_img" src="<?php echo url_for('images/logo_website_text_3.0_black.svg'); ?>" alt="fair logo">
      </div>
