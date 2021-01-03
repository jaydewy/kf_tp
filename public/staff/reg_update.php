<?php
  require_once('../../private/initialize.php');

  if (isset($_GET['lot_ids'])) {
    $lot_ids = $_GET['lot_ids'];
    // $lot_ids = unserialize(urldecode($lot_ids));
    $cust_ids = array();
    foreach ($lot_ids as $lot_id) {
      $cust_ids[] = get_lot_customer($lot_id);
    }
    $cust_ids = array_unique($cust_ids);
    if (sizeof($cust_ids) != 1) {
      // display an error message and redirect if more than one customer
      redirect_to(url_for('/staff/registration.php'));
    }
    else {
      $cust_id = $cust_ids[0];
      $customer = get_customer_by_id($cust_id); // to display customer info in update form
      $url_lot_ids = u(serialize($lot_ids)); // to pass to reg_admission.php
    }
  }
  else redirect_to(url_for('/staff/registration.php'));

  $page_title = 'Registration - Update Customer';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
 ?>

    <div class="content">
      <div class="">
        <!-- Customer info update form -->
        <form class="customer-form"
              id="reg_update_customer_form"
              action="<?php echo url_for('/staff/reg_update_process.php?lot_ids=' . $url_lot_ids); ?>"
              method="post">
        <?php include_once(SHARED_PATH . '/cust_update_form.php'); ?>
      </div>
      <button class="" type="button">
        <a href="<?php echo url_for('/staff/reg_admission.php?lot_ids=' . $url_lot_ids . '&cust_id=' . $cust_id); ?>">
          Continue
        </a>
      </button>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
