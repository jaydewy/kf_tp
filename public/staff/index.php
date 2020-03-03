<?php require_once('../../private/initialize.php'); ?>

<?php
  $page_title = 'KF Trailer Park - Home';
  $lots = get_vacant_lots();
?>

<?php // begin page structure ?>

<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
<?php require_once(SHARED_PATH . '/staff_sidebar.php'); ?>

    <div class="content">

      <table class="">
        <caption>Open Lots</caption>
        <thead>
          <tr>
            <th>Lot Number</th>
            <th>Lot Size</th>
          </tr>
        </thead>
        <tbody>
          <?php // code to pull db info into table ?>
          <?php while ($lot = mysqli_fetch_assoc($lots)) { ?>
            <tr>
              <td><?php echo h($lot['lot_name']); ?></td>
              <td><?php echo h($lot['lot_size']); ?></td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <td>Total</td>
            <td><?php ?></td>
          </tr>
        </tfoot>
      </table>

    </div>

<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
