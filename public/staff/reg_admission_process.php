<?php
  require_once('../../private/initialize.php');
  if (is_post_request()) {
    $admit = $_POST['admit'];
    $lot_ids = $_POST['lot_ids'];
    $lot_ids = unserialize(hd($lot_ids));
    foreach ($lot_ids as $lot_id) {
      echo 'Lot id: ' . $lot_id . '<br>';
      echo $admit[$lot_id]['adult_wknd_admits'] . '<br>';
      echo $admit[$lot_id]['child_wknd_admits'] . '<br>';
      echo $admit[$lot_id]['adult_day_admits'] . '<br>';
      echo $admit[$lot_id]['child_day_admits'] . '<br>';
      echo $admit[$lot_id]['vehicle_admits'] . '<br>';
      echo $admit[$lot_id]['will_preregister'];
    }
  }
  else {
    redirect_to(url_for('/staff/registration.php'));
  }
?>
