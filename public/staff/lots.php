<?php
  require_once('../../private/initialize.php');

  if (isset($_GET['people_id'])) {
    $lot_set = get_lots_by_customer($_GET['people_id']);
  }
  else if (isset($_GET['lot_id'])) {
    redirect_to(url_for('/staff/lot_details.php?lot_id=' . $_GET['lot_id']));
  }
  else {
    $lot_set = get_all_lots();
  }

  $page_title = 'Lots';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

    <div class="toolbar">
      <input class="toolbar_button" form="main" type="submit" name="command" value="Lot Details">
    </div>

    <div class="content">
      <form id="main" action="" method="GET">
        <table class="">
          <caption>Lots</caption>
          <thead>
            <th></th>
            <th>Lot Number</th>
            <th>Lot Size</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Telephone</th>
            <th>Cell Phone</th>
            <th>City</th>
          </thead>
          <tbody>
            <?php while ($lot = mysqli_fetch_assoc($lot_set)) { ?>
              <tr>
                <td><input type="radio" name="lot_id" value=<?php echo h($lot['lot_id']); ?>></td>
                <td><?php echo h($lot['lot_name']); ?></td>
                <td><?php echo h($lot['lot_size']); ?></td>
                <td><?php echo h($lot['last_name']); ?></td>
                <td><?php echo h($lot['first_name']); ?></td>
                <td><?php echo h($lot['telephone']); ?></td>
                <td><?php echo h($lot['cell_phone']); ?></td>
                <td><?php echo h($lot['city']); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
