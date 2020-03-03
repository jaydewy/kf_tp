<?php
  require_once('../../private/initialize.php');

  if (isset($_GET['query'])) {
    if ($_GET['query_type'] == 'last_name') {
      $search_result = reg_search_lastname($_GET['query']);
    }
    else if ($_GET['query_type'] == 'lot_name') {
      $search_result = reg_search_lotname($_GET['query']);
    }
    else redirect_to(url_for('/staff/registration.php'));
  }
  else redirect_to(url_for('/staff/registration.php'));

  $page_title = 'Registration - Search Result';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

    <div class="content">
      <form id="reg_select" action="reg_admission.php" method="POST">
        <table class="">
          <caption>Lots</caption>
          <thead>
            <th></th>
            <th>Lot Number</th>
            <th>Last Name</th>
            <th>First Name</th>
          </thead>
          <tbody>
            <?php while ($lot = mysqli_fetch_assoc($search_result)) { ?>
              <tr>
                <label><td><input type="checkbox" name="lot_ids[]" value=<?php echo h($lot['lot_id']); ?>></td></label>
                <td><?php echo h($lot['lot_name']); ?></td>
                <td><?php echo h($lot['last_name']); ?></td>
                <td><?php echo h($lot['first_name']); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <input type="submit" value="Register">
      </form>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
