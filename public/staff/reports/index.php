<?php require_once('../../../private/initialize.php'); ?>
<?php
  $page_title = 'Reports';
?>
<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
<?php require_once(SHARED_PATH . '/staff_sidebar.php'); ?>
    <div class="toolbar">
      Make this date dynamic later <?php echo date("D F j Y h:i:s a"); ?>
    </div>
    <div class="content">
      <li><a href="<?php echo url_for('/staff/reports/endofday.php'); ?>">End of Day</a></li>
      <li><a href="<?php ?>"></a></li>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
