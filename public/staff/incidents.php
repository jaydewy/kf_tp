<?php
  require_once('../../private/initialize.php');



  $page_title = 'Incidents';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
 ?>

    <div class="content">
      Enter incident report
      <div class="">
        <form class="" action="">
          Incident Date<input type="date" name="incident_date" value=""><br>
          Incident Time<input type="time" name="incident_time"><br>
          Lot<br>
          Type<br>
          Description<input type="text" name="incident_description"><br>
          Was security involved?<input type="checkbox" name="security_called"><br>
          Was police called?<input type="checkbox" name="police_called"><br>
          Has the incident been resolved?<input type="checkbox" name="resolved"><br>
          Additional notes<input type="text" name="notes"><br>
          <input type="reset" value="Reset">
          <input type="submit" value="Submit incident report">
        </form>
      </div>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
