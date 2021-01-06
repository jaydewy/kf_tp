<?php require_once('../../private/initialize.php');
      if (is_get_request()) {
      $license_plate = $_GET['licence_plate'];
      $adult_wknd_admits = $_GET['adult_wknd_admits'];
      $adult_day_admits = $_GET['adult_day_admits'];
      $child_wknd_admits = $_GET['child_wknd_admits'];
      $child_day_admits = $_GET['child_day_admits'];
      $additional_vehicles = $_GET['vehicle_admits'];
      // insert_admission($licence_plate, $adult_admits, $child_admits, $additional_vehicles);
      $adult_wknd_fee = get_fees('adult_weekend');
      $child_wknd_fee = get_fees('child_weekend');
      $adult_day_fee = get_fees('adult_daily');
      $child_day_fee = get_fees('child_daily');
      $vehicle_fee = get_fees('parking_daily');

      $adult_wknd_sub = $adult_wknd_admits*$adult_wknd_fee;
      $child_wknd_sub = $child_wknd_admits*$child_wknd_fee;
      $adult_day_sub = $adult_day_admits*$adult_day_fee;
      $child_day_sub = $child_day_admits*$child_day_fee;
      $vehicle_sub = $additional_vehicles*$vehicle_fee;

      $grand_total = $adult_wknd_sub + $child_wknd_sub + $adult_day_sub + $child_day_sub + $vehicle_sub;
      }
      else {
        redirect_to(url_for('/staff/admissions.php'));
      }

      $page_title = 'Admissions - Payment';
?>
<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
<?php require_once(SHARED_PATH . '/staff_sidebar.php'); ?>
<div class="content">
  <h2>Summary</h2>
    <table class="">
      <tr>
        <td>Adult Weekend</td>
        <td>x<?php echo $adult_wknd_admits . ' @' . $adult_wknd_fee; ?></td>
        <td>$<?php echo $adult_wknd_sub; ?></td>
      </tr>
      <tr>
        <td>Child Weekend</td>
        <td>x<?php echo $child_wknd_admits . ' @' . $child_wknd_fee; ?></td>
        <td>$<?php echo $child_wknd_sub; ?></td>
      </tr>
      <tr>
        <td>Adult Day</td>
        <td>x<?php echo $adult_day_admits . ' @' . $adult_day_fee; ?></td>
        <td>$<?php echo $adult_day_sub; ?></td>
      </tr>
      <tr>
        <td>Child Day</td>
        <td>x<?php echo $child_day_admits . ' @' . $child_day_fee; ?></td>
        <td>$<?php echo $child_day_sub; ?></td>
      </tr>
      <tr>
        <td>Vehicle Passes</td>
        <td>x<?php echo $additional_vehicles . ' @' . $vehicle_fee; ?></td>
        <td>$<?php echo $vehicle_sub; ?></td>
      </tr>
      <tr>
        <td colspan="2"><b>GRAND TOTAL</b></td>
        <td><?php echo '$' . $grand_total; ?></td>
      </tr>
    </table>
    <div class="">
      <form id="" class="" action="admit_payment_process.php" method="post">
        <label>
          <input type="radio" name="payment_method" value="cash">Cash</label><br>
        <label>
          <input type="radio" name="payment_method" value="cheque">Cheque</label>
          <input type="number" name="chequeno" value="0" min=0>Cheque Number<br>
        <label>
          <input type="radio" name="payment_method" value="debit">Debit</label>
          <input type="text" name="debit_digits" value="0000">Last 4 Digits of Debit Card Number<br>
        <input type="hidden" name="" value="">
        <input type="submit" value="Complete Payment">
      </form>
    </div>
  </div>
  <?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
