<?php
  require_once('../../private/initialize.php');
  $page_title = 'New Customer';

  if(is_post_request()) { // form processing
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $prov = $_POST['prov'];
    $postal_code = $_POST['postal_code'];
    $telephone = $_POST['telephone'];
    $cell_phone = $_POST['cell_phone'];
    $email = $_POST['email'];

    $result = insert_customer($last_name, $first_name, $address, $city, $prov, $postal_code, $telephone, $cell_phone, $email);
    // $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/customers.php'));
  }
  else { // default form values
    $last_name = '';
    $first_name = '';
    $address = '';
    $city = '';
    $prov = '';
    $postal_code = '';
    $telephone = '';
    $cell_phone = '';
    $email = '';
  }

  require_once(SHARED_PATH . '/staff_header.php');
  require_once(SHARED_PATH . '/staff_sidebar.php');
?>
    <div class="content">
      <form class="customer-form" id="new_customer" action="" method="post"> <!-- need to add labels and breaks still -->
        <fieldset>
          <legend>Personal Information</legend>
          First Name: <input type="text" name="first_name" value="<?php echo h($first_name) ?>">
          Last Name: <input type="text" name="last_name" value="<?php echo h($last_name) ?>">
          Address: <input type="text" name="address" value="<?php echo h($address) ?>">
          City: <input type="text" name="city" value="<?php echo h($city) ?>">
          Province: <select name="prov">
                      <option value="AB">Alberta</option>
                      <option value="BC">British Columbia</option>
                      <option value="MB">Manitoba</option>
                      <option value="NB">New Brunswick</option>
                      <option value="NL">Newfoundland and Labrador</option>
                      <option value="NS">Nova Scotia</option>
                      <option value="NT">Northwest Territories</option>
                      <option value="NU">Nunavut</option>
                      <option value="ON" selected>Ontario</option>
                      <option value="PE">Prince Edward Island</option>
                      <option value="QC">Quebec</option>
                      <option value="SK">Saskatchewan</option>
                      <option value="YT">Yukon</option>
                    </select>
          Postal Code: <input type="text" name="postal_code" value="<?php echo h($postal_code) ?>">
          Telephone: <input type="tel" name="telephone" value="<?php echo h($telephone) ?>">
          Cell Phone: <input type="tel" name="cell_phone" value="<?php echo h($cell_phone) ?>">
          Email: <input type="email" name="email" value="<?php echo h($email) ?>">
          <input type="submit" value="Submit"><input type="reset">
        </fieldset>
      </form>
    </div>
<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
