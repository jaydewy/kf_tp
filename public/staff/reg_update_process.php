<?php
  require_once('../../private/initialize.php');
  if (is_post_request()) {
    $id = $_POST['id'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $prov = $_POST['prov'];
    $postal_code = $_POST['postal_code'];
    $telephone = $_POST['telephone'];
    $cell_phone = $_POST['cell_phone'];
    $email = $_POST['email'];

    $result = update_customer($id, $address, $city, $prov, $postal_code, $telephone, $cell_phone, $email);
    // add error handling for update
    $url_lot_ids = $_GET['lot_ids'];
    redirect_to(url_for('/staff/reg_admission.php?lot_ids=' . $url_lot_ids));
  }
  else {
    redirect_to(url_for('/staff/registration.php'));
  }
?>
