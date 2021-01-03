<?php
/* TO DO:
  * add input verification
  * allow for split payment
  * allow for cheque number entry, last 4 digits of card entry
  * add preregistration functionality (after implemented elsewhere)
  */
  require_once('../../private/initialize.php');

  if (is_post_request()) {
    /* form data from reg_admission
     * $lot_ids[]
     * $admit[lot_id][opt]
     * opts:
     *  adult_wknd_admits
     *  child_wknd_admits
     *  adult_day_admits
     *  child_day_admits
     *  vehicle_admits
     *  will_preregister
     */
     $admit = $_POST['admit'];
     $cust_id = $_POST['cust_id'];
     $lot_ids = $_POST['lot_ids'];
     $lot_ids = unserialize(hd($lot_ids));

     $customer = get_customer_by_id($cust_id);
     // calculate subtotals
     //$lot_fees = reg_lot_costs($lot_ids);
     //$lot_prepayments = reg_lot_payments($lot_ids);
     $adult_wknd_fee = get_fees('adult_weekend');
     $child_wknd_fee = get_fees('child_weekend');
     $adult_day_fee = get_fees('adult_daily');
     $child_day_fee = get_fees('child_daily');
     $vehicle_fee = get_fees('parking_daily');
     // echo $adult_wknd_fee;
     // echo $child_wknd_fee;
     // echo $adult_day_fee;
     // echo $child_day_fee;
     // echo $vehicle_fee;
     $grand_total = 0;
  }
  else redirect_to(url_for('/staff/registration.php'));

  $page_title = 'Registration - Payment';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
 ?>

    <div class="content">
      <h2>Summary</h2>
      <table class="">
        <?php foreach ($lot_ids as $lot_id) { ?>
          <?php
            $lot = get_lot_by_id($lot_id);
            $adult_wknd_sub = $admit["$lot_id"]['adult_wknd_admits']*$adult_wknd_fee;
            $child_wknd_sub = $admit["$lot_id"]['child_wknd_admits']*$child_wknd_fee;
            $adult_day_sub = $admit["$lot_id"]['adult_day_admits']*$adult_day_fee;
            $child_day_sub = $admit["$lot_id"]['child_day_admits']*$child_day_fee;
            $vehicle_sub = $admit["$lot_id"]['vehicle_admits']*$vehicle_fee;
            $admission_sub = $adult_wknd_sub + $child_wknd_sub + $adult_day_sub + $child_day_sub + $vehicle_sub;
            $lot_prepayment = get_payment($lot_id);
            $lot_sub = $admission_sub + $lot['lot_value'] - $lot_prepayment;
            $grand_total += $lot_sub;
          ?>
          <tr>
            <td>
              <h3>Lot <?php echo $lot['lot_name']; ?></h3>
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Adult Weekend</td>
            <td>x<?php echo $admit["$lot_id"]['adult_wknd_admits']; ?></td>
            <td>$<?php echo $adult_wknd_sub; ?></td>
          </tr>
          <tr>
            <td>Child Weekend</td>
            <td>x<?php echo $admit["$lot_id"]['child_wknd_admits']; ?></td>
            <td>$<?php echo $child_wknd_sub; ?></td>
          </tr>
          <tr>
            <td>Adult Day</td>
            <td>x<?php echo $admit["$lot_id"]['adult_day_admits']; ?></td>
            <td>$<?php echo $adult_day_sub; ?></td>
          </tr>
          <tr>
            <td>Child Day</td>
            <td>x<?php echo $admit["$lot_id"]['child_day_admits']; ?></td>
            <td>$<?php echo $child_day_sub; ?></td>
          </tr>
          <tr>
            <td>Vehicle Passes</td>
            <td>x<?php echo $admit["$lot_id"]['vehicle_admits']; ?></td>
            <td>$<?php echo $vehicle_sub; ?></td>
          </tr>
          <tr>
            <td></td>
            <td>Subtotal - Admissions - Lot <?php echo $lot['lot_name']; ?></td>
            <td>$<?php echo $admission_sub; ?></td>
          </tr>
          <tr>
            <td>Lot Fee</td>
            <td></td>
            <td>$<?php echo $lot['lot_value']; ?></td>
          </tr>
          <tr>
            <td>Lot Fee Paid</td>
            <td></td>
            <td>-$<?php echo $lot_prepayment; ?></td>
          </tr>
          <tr>
            <td></td>
            <td>Subtotal - Lot <?php echo $lot['lot_name']; ?></td>
            <td>$<?php echo $lot_sub; ?></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        <?php } // end foreach ?>
        <tr>
          <td></td>
          <td>GRAND TOTAL</td>
          <td>$<?php echo $grand_total; ?></td>
        </tr>
      </table>
      <div class="">
        <form id="" class="" action="reg_payment_process.php" method="post">
          <label>
            <input type="radio" name="payment_method" value="cash">Cash</label><br>
          <label>
            <input type="radio" name="payment_method" value="cheque">Cheque</label>
            <input type="number" name="chequeno" value="0" min=0>Cheque Number<br>
          <label>
            <input type="radio" name="payment_method" value="debit">Debit</label>
            <input type="text" name="debit_digits" value="0000">Last 4 Digits of Debit Card Number<br>
          <input type="hidden" name="lot_ids" value="<?php echo h(serialize($lot_ids)); ?>">
          <input type="hidden" name="admit" value="<?php echo h(serialize($admit)); ?>">
          <input type="hidden" name="cust_id" value="<?php echo h(serialize($cust_id)); ?>">
          <input type="submit" value="Complete Registration">
        </form>
      </div>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
