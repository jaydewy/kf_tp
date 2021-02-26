<?php
  require_once('../../private/initialize.php');

  if (isset($_GET['lot_ids'])) {
    $cust_id = urldecode($_GET['cust_id']);
    $customer = get_customer_by_id($cust_id);

    $lot_ids = $_GET['lot_ids'];
    $lot_ids = unserialize(urldecode($lot_ids));
    // $lot_set = reg_lot_list($lot_ids);
  }
  else redirect_to(url_for('/staff/registration.php'));

  $page_title = 'Registration - Admissions';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

    <div class="content">
      <!-- Admissions form -->
      <div class="">
        <h2>Customer: <?php echo $customer['first_name'] . ' ' . $customer['last_name']; ?></h2>
        <form id="reg_admit_form" action="reg_payment.php" method="post">
          <?php foreach ($lot_ids as $lot_id) { ?>
            <?php $lot = get_lot_by_id($lot_id); ?>
            <h2>Lot <?php echo $lot['lot_name']; ?></h2> <!-- add in prepayment info for lot -->
            <?php // check if the lot was preregistered and display info
            $prereg_ids = find_prereg($lot_id);
              if (mysqli_num_rows($prereg_ids) == 0) {
                echo '<p>Not preregistered</p>';
                echo '<p>Amount owing: $' . $lot['lot_value'] . '</p>';
              }
              else if (mysqli_num_rows($prereg_ids) == 1) { // exactly one prereg, preregistered
                $prereg_id = mysqli_fetch_assoc($prereg_ids);
                $prereg_id = $prereg_id['prereg_id'];
                $prereg = select_prereg($prereg_id);
                $prereg = mysqli_fetch_assoc($prereg);
                echo '<p>Preregistered on ' . $prereg['date'] . '</p>';
                echo '<p>Amount paid: $' . $prereg['payment_amount'] . '</p>';
                echo '<p>Amount owing: $' . $lot['lot_value'] - $prereg['payment_amount'] . '</p>';
              }
              else { // more than one available prereg - unusal scenario
                echo '<p>Multiple unused preregistrations found</p>';
                while ($prereg_id = mysqli_fetch_assoc($prereg_ids)) {
                  $prereg_id = $prereg_id['prereg_id'];
                  $prereg = select_prereg($prereg_id);
                  $prereg = mysqli_fetch_assoc($prereg);
                  echo '<p>Preregistered on ' . $prereg['date'] . '</p>';
                  echo '<p>Amount paid: $' . $prereg['payment_amount'] . '</p>';
                  echo '<p>Amount owing: $' . '' . '</p>';
                }
              }
            ?>
            <fieldset name="wknd_pass_lot_<?php echo $lot_id; ?>">
              <legend>Weekend Passes</legend>
              <label>Adult weekend<br>
              <input type="number" name="admit[<?php echo $lot_id; ?>][adult_wknd_admits]" value="0" min="0"></label><br>
              <label>Child weekend<br>
              <input type="number" name="admit[<?php echo $lot_id; ?>][child_wknd_admits]" value="0" min="0"></label><br>
            </fieldset>
            <fieldset name="day_pass_lot_<?php echo $lot_id; ?>">
              <legend>Daily Passes</legend>
              <label>Adult daily<br>
              <input type="number" name="admit[<?php echo $lot_id; ?>][adult_day_admits]" value="0" min="0"></label><br>
              <label>Child daily<br>
              <input type="number" name="admit[<?php echo $lot_id; ?>][child_day_admits]" value="0" min="0"></label><br>
            </fieldset>
            <fieldset name="parking_pass_lot_<?php echo $lot_id; ?>">
              <legend>Parking Passes</legend>
              <label>Daily parking<br>
              <input type="number" name="admit[<?php echo $lot_id; ?>][vehicle_admits]" value="0" min="0"></label><br>
            </fieldset>
            <label><input type="checkbox" name="admit[<?php echo $lot_id; ?>][will_preregister]" value="1">Preregister this lot?</label>
          <?php } // end foreach ?>
          <!-- <button type="button" onclick="">Preregister?</button>
          <div class="form-hidden">
             preregistration option here - idea: use javascript to hide form elements until 'yes' is selected
          </div> -->
          <input type="hidden" name="lot_ids" value="<?php echo h(serialize($lot_ids)); ?>">
          <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
          <br>
          <input type="submit" value="Proceed to payment">
        </form>
      </div>
    </div>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
