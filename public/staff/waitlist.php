<?php
  require_once('../../private/initialize.php');

  if (is_post_request()) {

  }

  // echo 'Prior to customer query';
  $customers = get_all_customers();
  // echo 'Customer query ran';

  $page_title = 'Waitlist';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
 ?>

    <div class="content">
      <div class="">
        <form class="" id="waitlist-add-form" action="" method="post">
          <!-- figure out safe way to target self -->
          <label for="customer">Select Customer</label>
          <select id="" name="customer" required>
            <?php while ($cust = mysqli_fetch_assoc($customers)) { ?>
              <option value="<?php echo $cust['people_id']; ?>"><?php echo $cust['last_name'] . ', ' . $cust['first_name']; ?></option>
            <?php } ?>
          </select> <br>
          <label>Trailer Size
          <input type="number" name="trailer-length" required></label><br>
          <label>Lot Preference
          <input type="text" name="lot-preference"></label><br>
          <label>Notes
          <input type="text" name="notes"></label><br>
          <input type="hidden" name="date" value="">
          <input type="hidden" name="time" value="">
          <input type="reset" value="Reset">
          <input type="submit" value="Add">
        </form>
      </div>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
