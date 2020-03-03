<?php
  require_once('../../private/initialize.php');

  if (isset($_POST['lot_ids'])) {
    $lot_ids = $_POST['lot_ids'];
    $lot_prereg_set = reg_lot_list($lot_ids);

  }
  else redirect_to(url_for('/staff/registration.php'));

  $page_title = 'Registration - Admissions';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

    <div class="content">
      <div class="reg_customer_info">
        <form id="reg_update_customer_form" action="" method="post">
          <!-- get from update page when complete -->
        </form>
      </div>
      <div class="reg_lot_costs">
        <!-- table containing lots and what payments have been made on them -->
        <table>
          <caption>Lot Prepayments</caption>
          <thead>
            <tr>
              <th>Lot Number</th>
              <th>Prepayment</th>
              <th>Date Applied</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($lot = mysqli_fetch_assoc($lot_prereg_set)) { ?>
              <tr>
                <td><?php echo $lot['lot_name']; ?></td>
                <td><?php echo $lot['payment_amount']; ?></td>
                <td><?php echo $lot['payment_time']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="reg_admissions">
        <form id="reg_admit_form" action="" method="post">
          <fieldset>
            <legend>Weekend Passes</legend>
            <label>Adult weekend
            <input type="number" name="adult_wknd_admits" value="0" min="0"></label><br>
            <label>Child weekend
            <input type="number" name="child_wknd_admits" value="0" min="0"></label><br>
          </fieldset>
          <fieldset>
            <legend>Daily Passes</legend>
            <label>Adult daily
            <input type="number" name="adult_day_admits" value="0" min="0"></label><br>
            <label>Child daily
            <input type="number" name="child_day_admits" value="0" min="0"></label><br>
          </fieldset>
          <fieldset>
            <legend>Parking Passes</legend>
            <label>Daily parking
            <input type="number" name="vehicle_admits" value="0" min="0"></label><br>
          </fieldset>
          <input type="submit" value="Proceed">
        </form>
      </div>
      <div class="reg_prereg">
      </div>
    </div>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
