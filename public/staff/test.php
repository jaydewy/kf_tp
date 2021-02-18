<?php
  require_once('../../private/initialize.php');

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

<?php
// testing new insert_payment and new insert_admission
// testing complete
  // $total = 300;
  // $meth = 'debit';
  // // $payid = insert_payment($total,$meth);
  // // echo $payid . '\n';
  // // $admits = ['lp' => 'CDDF103', 'aw' => 2, 'ad' => 0, 'cw' => 2, 'cd' => 0, 'av' => 0];
  // // $admitid = insert_admission($payid,$admits);
  // // echo $admitid . '\n';
  // $admits = [ 601 => ['lp' => 'CDDF103', 'aw' => 2, 'ad' => 0, 'cw' => 2, 'cd' => 0, 'av' => 0],
  //             602 => 0, 603 => 0];
  // $lot_ids = [601, 602, 603];
  // $regids = register($lot_ids, $admits, $total, $meth);
  // var_dump($regids);
  // insert_checkin(601);
  // insert_checkin(601,['payment_id' => 190, 'admit_id' => 8, 'prereg_id' => 'NULL']);
?>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
