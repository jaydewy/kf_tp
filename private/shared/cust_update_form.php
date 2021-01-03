<!-- Need to include the following form opening tag in the page where the form will be located -->
<!--  <form class="customer-form" id="reg_update_customer_form" action="" method="post"> -->
    First Name: <?php echo h($customer['first_name']); ?><br>
    Last Name: <?php echo h($customer['last_name']); ?><br>
    <label>Address: <input type="text" name="address" value="<?php echo h($customer['address']); ?>"></label><br>
    <label>City: <input type="text" name="city" value="<?php echo h($customer['city']); ?>"></label><br>
    <label>Province: <select name="prov">
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
              </select></label><br>
    <label>Postal Code: <input type="text" name="postal_code" value="<?php echo h($customer['postal_code']); ?>"></label><br>
    <label>Telephone: <input type="text" name="telephone" value="<?php echo h($customer['telephone']); ?>"></label><br>
    <label>Cell Phone: <input type="text" name="cell_phone" value="<?php echo h($customer['cell_phone']); ?>"></label><br>
    <label>Email: <input type="text" name="email" value="<?php echo h($customer['email']); ?>"></label><br>
    <input type="hidden" name="id" value="<?php echo h($customer['people_id']); ?>">
    <input type="submit" value="Update"><input type="reset">
  </form>
