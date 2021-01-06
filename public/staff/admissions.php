<?php require_once('../../private/initialize.php'); ?>
<?php $page_title = 'Admissions'; ?>
<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
<?php require_once(SHARED_PATH . '/staff_sidebar.php'); ?>

<!-- Need to add menu to select lot they are joining (maybe) -->
    <div class="content">
      <form id="admission_form" action="admit_payment.php" method="get">
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
        <input type="hidden" name="licence_plate" value="">
        <input type="submit" value="Proceed">
      </form>
    </div>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
