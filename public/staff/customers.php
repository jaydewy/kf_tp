<?php
  require_once('../../private/initialize.php');

  if (isset($_GET['command']) && isset($_GET['people_id'])) {
    if ($_GET['command'] == 'Edit') {
      redirect_to(url_for('/staff/cust_update.php?people_id=' . $_GET['people_id']));
    }
    else if ($_GET['command'] == 'Show Customer Lots') {
      redirect_to(url_for('/staff/lots.php?people_id=' . $_GET['people_id']));
    }
    // else if ($_GET['command'] == 'Delete') {
    //    redirect_to(url_for('/staff/delete_customer.php?people_id=' . $_GET['people_id']));
    // }
  }

  $page_title = 'Customers';

  $people_set = get_all_customers();

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

    <div class="toolbar">
      <a href="<?php echo url_for('staff/cust_new.php'); ?>"><button class="toolbar_button" type="button">New Customer</button></a>
      <input class="toolbar_button" form="main" type="submit" name="command" value="Edit">
      <input class="toolbar_button" form="main" type="submit" name="command" value="Show Customer Lots">
      <!--<input class="toolbar_button" form="main" type="submit" name="command" value="Delete">-->
    </div>

    <div class="content">
      <form id="main" action="" method="GET">
        <table class="">
          <caption>Customers</caption>
          <thead>
            <tr>
              <th></th>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Phone Number</th>
              <th>Cell Number</th>
              <th>Address</th>
              <th>City</th>
              <th>FoF</th>
              <th>ID</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($cust = mysqli_fetch_assoc($people_set)) { ?>
              <tr>
                <td><input type="radio" name="people_id" value="<?php echo h($cust['people_id']); ?>"></td>
                <td><?php echo h($cust['last_name']); ?></td>
                <td><?php echo h($cust['first_name']); ?></td>
                <td><?php echo h($cust['telephone']); ?></td>
                <td><?php echo h($cust['cell_phone']); ?></td>
                <td><?php echo h($cust['address']); ?></td>
                <td><?php echo h($cust['city']); ?></td>
                <td><?php echo ($cust['friend'] ? 'YES' : 'NO'); ?></td>
                <td><?php echo h($cust['people_id']); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
    </div>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
