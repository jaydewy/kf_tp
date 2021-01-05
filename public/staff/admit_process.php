<?php require_once('../../private/initialize.php');
      if (is_get_request()) {
      $license_plate = $_GET['licence_plate'];
      $adult_wknd_admits = $_GET['adult_wknd_admits'];
      $adult_day_admits = $_GET['adult_day_admits'];
      $child_wknd_admits = $_GET['child_wknd_admits'];
      $child_day_admits = $_GET['child_day_admits'];
      $additional_vehicles = $_GET['vehicle_admits'];
      // insert_admission($licence_plate, $adult_admits, $child_admits, $additional_vehicles);
      }
      else {
        redirect_to(url_for('/staff/admissions.php'));
      }
?>
