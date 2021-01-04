<?php require_once('../../private/initialize.php'); ?>
<?php
  if (is_post_request()) {
    if (isset($_POST['lot_id'])) {
      $lot_id = $_POST['lot_id'];
    }
    else $lot_id = NULL;
    $license_plate = $_POST['licence_plate'];
    $adult_admits = $_POST['adult_wknd_admits'] + $_POST['adult_day_admits'];
    $child_admits = $_POST['child_wknd_admits'] + $_POST['child_day_admits'];
    $additional_vehicles = $_POST['vehicle_admits'];
    insert_admission($licence_plate, $adult_admits, $child_admits, $additional_vehicles);
    redirect_to(url_for('/staff/admissions.php'));
  }
?>

<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
<?php require_once(SHARED_PATH . '/staff_sidebar.php'); ?>

    <div class="content">
      <form id="admission_form" action="" method="post">
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

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
