<?php
  require_once('../../private/initialize.php');

  if (isset($_GET['lot_id'])) {
    $lot = get_lot_by_id($_GET['lot_id']);
    $img_fname = '../images/TP Lots/lot_id_' . make_id_string($_GET['lot_id']) . '.jpg';
  }
  else {
    redirect_to(url_for('/staff/lots.php'));
  }

  $page_title = 'Lot '. $lot['lot_name'] . ' details';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

    <div class="toolbar">
      <a href="<?php echo url_for('/staff/lots.php'); ?>">&lt;&lt;&lt;Back to lots</a>
    </div>

    <div class="content">
      <h1><?php echo 'Lot ' . $lot['lot_name']; ?></h1>
      <p><?php echo 'Lot id: ' . $lot['lot_id']; ?></p>
      <p><?php echo 'Lot size: ' . $lot['lot_size'] . 'ft'; ?></p>
      <p><?php echo 'Lot type: ' . $lot['lot_type']; ?></p>
      <p><?php echo 'Lot value: $' . $lot['lot_value']; ?></p>
      <p><?php echo 'Lot reservable: ' . $lot['lot_reservable']; ?></p>
      <p><?php echo 'Notes: ' . $lot['notes']; ?></p>
      <img class="lot-image" src="<?php echo $img_fname; ?>" alt="Lot image not available">
      <h2>Customer information</h2>
      <p><?php echo 'First name: ' . $lot['first_name']; ?></p>
      <p><?php echo 'Last name: ' . $lot['last_name']; ?></p>
      <p><?php echo 'Address: ' . $lot['address']; ?></p>
      <p><?php echo 'City: ' . $lot['city']; ?></p>
      <p><?php echo 'Postal Code: ' . $lot['postal_code']; ?></p>
      <p><?php echo 'Phone number: ' . $lot['telephone']; ?></p>
      <p><?php echo 'Cell phone: ' . $lot['cell_phone']; ?></p>
      <p><?php echo 'Email address: ' . $lot['email']; ?></p>
    </div>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
