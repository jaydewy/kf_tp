<?php
  require_once('../../private/initialize.php');

  if (isset($_GET['query']) && isset($_GET['query_type'])) {
    redirect_to(url_for('/staff/reg_select.php?query=' . $_GET['query'] . '&query_type=' . $_GET['query_type']));
  }
  else

  $page_title = 'Registration';

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>

    <div class="content">
      <form id="reg_search" action="" method="GET">
        <input type="search" name="query" placeholder="Search...">
        <input type="radio" name="query_type" value="last_name" checked>Search by last name</input>
        <input type="radio" name="query_type" value="lot_name">Search by lot number</input>
        <input type="submit" value="search">
      </form>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
