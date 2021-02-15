<?php
  require_once('../../private/initialize.php');

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

<?php
  $total = 300;
  $meth = 'debit';
  $payid = insert_payment($total,$meth);
  echo $payid . '\n';
  $admits = ['lp' => 'CDDF103', 'aw' => 2, 'ad' => 0, 'cw' => 2, 'cd' => 0, 'av' => 0];
  $admitid = insert_admission($payid,$admits);
  echo $admitid . '\n';

?>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
