<?php
  require_once('../../private/initialize.php');

  if (isset($_POST['lot_ids'])) {
    $lot_ids = $_POST['lot_ids'];
    $lot_set = reg_lot_list($lot_ids);

  }
  else redirect_to(url_for('/staff/registration.php'));

  $page_title = 'Registration - Admissions';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

    <div class="content">
      <div class="">
        <form class="customer-form" id="reg_update_customer_form" action="" method="post">
          <!-- get from update page when complete -->
        </form>
      </div>

      <div class="">
        <form id="reg_admit_form" action="reg_admit_process.php" method="post">
          <?php while ($lot = mysqli_fetch_assoc($lot_set)) { ?>
            <h1>Lot <?php echo $lot['lot_name']; ?></h1> <!-- add in prepayment info for lot -->
            <?php
              if ($lot['payment_amount'] == NULL) {
                echo '<p>Not preregistered</p>';
              }
              else {
                echo '<p>Preregistered on ' . $lot['payment_date'] . '</p>';
                echo '<p>Amount paid: $' . $lot['payment_amount'] . '</p>';
                echo '<p>Amount owing: $' . '' . '</p>';
              }
            ?>
            <input type="hidden" name="lot_ids[]" value="<?php echo $lot['lot_id']; ?>">
            <fieldset name="wknd_pass_lot_<?php echo $lot['lot_id']; ?>">
              <legend>Weekend Passes</legend>
              <label>Adult weekend<br>
              <input type="number" name="admit[<?php echo $lot['lot_id']; ?>][adult_wknd_admits]" value="0" min="0"></label><br>
              <label>Child weekend<br>
              <input type="number" name="admit[<?php echo $lot['lot_id']; ?>][child_wknd_admits]" value="0" min="0"></label><br>
            </fieldset>
            <fieldset name="day_pass_lot_<?php echo $lot['lot_id']; ?>">
              <legend>Daily Passes</legend>
              <label>Adult daily<br>
              <input type="number" name="admit[<?php echo $lot['lot_id']; ?>][adult_day_admits]" value="0" min="0"></label><br>
              <label>Child daily<br>
              <input type="number" name="admit[<?php echo $lot['lot_id']; ?>][child_day_admits]" value="0" min="0"></label><br>
            </fieldset>
            <fieldset name="parking_pass_lot_<?php echo $lot['lot_id']; ?>">
              <legend>Parking Passes</legend>
              <label>Daily parking<br>
              <input type="number" name="admit[<?php echo $lot['lot_id']; ?>][vehicle_admits]" value="0" min="0"></label><br>
            </fieldset>
            <label><input type="checkbox" name="preregister" value="">Preregister this lot?</label>
          <?php } ?>
          <!-- <button type="button" onclick="">Preregister?</button>
          <div class="form-hidden">
             preregistration option here - idea: use javascript to hide form elements until 'yes' is selected
          </div> -->
          <input type="submit" value="Proceed to paymen">
        </form>
      </div>
    </div>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
