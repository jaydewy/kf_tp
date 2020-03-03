<?php require_once('../../private/initialize.php'); ?>

<?php
if (is_post_request()) {
  $id = $_POST['id'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $prov = $_POST['prov'];
  $postal_code = $_POST['postal_code'];
  $telephone = $_POST['telephone'];
  $cell_phone = $_POST['cell_phone'];
  $email = $_POST['email'];

  $result = update_customer($id, $address, $city, $prov, $postal_code, $telephone, $cell_phone, $email);
  redirect_to(url_for('/staff/customers.php'));
}
else if (!isset($_GET['people_id'])) {
  redirect_to(url_for('/staff/customers.php'));
}
else {
  $customer = get_customer_by_id($_GET['people_id']);
}
?>

<?php require_once(SHARED_PATH . '/staff_header.php'); ?>
<?php require_once(SHARED_PATH . '/staff_sidebar.php'); ?>

    <div class="content">
      <form class="customer-form" id="update_customer" action="" method="post"> <!-- need to add labels and breaks still -->
        First Name: <?php echo h($customer['first_name']); ?>
        Last Name: <?php echo h($customer['last_name']); ?>
        Address: <input type="text" name="address" value="<?php echo h($customer['address']); ?>">
        City: <input type="text" name="city" value="<?php echo h($customer['city']); ?>">
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
        Postal Code: <input type="text" name="postal_code" value="<?php echo h($customer['postal_code']); ?>">
        Telephone: <input type="text" name="telephone" value="<?php echo h($customer['telephone']); ?>">
        Cell Phone: <input type="text" name="cell_phone" value="<?php echo h($customer['cell_phone']); ?>">
        Email: <input type="text" name="email" value="<?php echo h($customer['email']); ?>">
        <input type="hidden" name="id" value="<?php echo h($_GET['people_id']); ?>">
        <input type="submit" value="Update"><input type="reset">
      </form>
    </div>


<?php require_once(SHARED_PATH . '/staff_footer.php'); ?>
