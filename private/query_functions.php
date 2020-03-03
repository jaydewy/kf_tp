<?php
// Queries that should return only one record return an associative array
// Queries that should return multiple records return the result set
// Queries that do not return a record(s) return TRUE or FALSE
// Queries that should return a numeric value do so.

/* Customer queries */

function get_all_customers() {
  global $db;

  $sql = "SELECT * FROM people ";
  $sql .= "ORDER BY last_name ASC";

  $people_set = mysqli_query($db, $sql);
  confirm_result_set($people_set);

  return $people_set;
}

function get_customer_by_id($id) {
  global $db;

  $sql = "SELECT * FROM people ";
  $sql .= "WHERE people_id='" . $id . "'";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $customer = mysqli_fetch_assoc($result);
  mysqli_free_result($result);

  return $customer;
}

function insert_customer($last_name, $first_name, $address, $city, $prov, $postal_code, $telephone, $cell_phone, $email) {
  global $db;

  $sql = 'INSERT INTO people ';
  $sql .= '(last_name, first_name, address, city, prov, postal_code, telephone, cell_phone, email) ';
  $sql .= 'VALUES (';
  $sql .= "'$last_name', '$first_name', '$address', '$city', '$prov', '$postal_code', '$telephone', '$cell_phone', '$email'";
  $sql .= ')';
  $result = mysqli_query($db, $sql);

  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_customer($id, $address, $city, $prov, $postal_code, $telephone, $cell_phone, $email) {
  global $db;

  $sql = 'UPDATE People SET ';
  $sql .= 'address=\'' . $address;
  $sql .= '\', city=\'' . $city . '\', prov=\'' . $prov . '\', postal_code=\'' . $postal_code;
  $sql .= '\', telephone=\'' . $telephone . '\', cell_phone=\'' . $cell_phone . '\', email=\'' . $email . '\' ';
  $sql .= 'WHERE people_id=\'' . $id . '\'';

  $result = mysqli_query($db, $sql);

  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function delete_customer($id) {
  global $db;

  $sql = 'DELETE FROM people ';
  $sql .= 'WHERE people_id=\'' . $id . '\'';

  $result = mysqli_query($db, $sql);

  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

/* Lot queries */

function get_all_lots() {
  global $db;

  $sql = 'SELECT * FROM Lots ';
  $sql .= 'LEFT JOIN People '; // use LEFT JOIN because we want vacant lots also.
  $sql .= 'ON Lots.people_id=People.people_id ';
  $sql .= 'ORDER BY Lots.lot_id ASC';

  $lot_set = mysqli_query($db, $sql);
  confirm_result_set($lot_set);

  return $lot_set;
}

function get_vacant_lots() {
  global $db;

  $sql = "SELECT * FROM lots ";
  $sql .= "WHERE people_id IS NULL ";
  $sql .= "ORDER BY lot_name ASC";

  $vacant_lots = mysqli_query($db, $sql);
  confirm_result_set($vacant_lots);

  return $vacant_lots;
}

function get_lot_by_id($id) {
  global $db;

  $sql = 'SELECT * FROM Lots ';
  $sql .= 'INNER JOIN People ';
  $sql .= 'ON Lots.people_id=People.people_id ';
  $sql .= 'WHERE Lots.lot_id=\'' . $id . '\'';

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $lot = mysqli_fetch_assoc($result);
  mysqli_free_result($result);

  return $lot;
}

function get_lots_by_customer($cust_id) {
  global $db;

  $sql = 'SELECT * FROM Lots ';
  $sql .= 'INNER JOIN People ';
  $sql .= 'ON Lots.people_id=People.people_id ';
  $sql .= 'WHERE People.people_id=\'' . $cust_id . '\'';

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);

  return $result;
}

function get_lot_customer($lot_id) {
  global $db;

  $sql = 'SELECT people_id FROM lots ';
  $sql .= 'WHERE lot_id=\'' . $lot_id . '\'';

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);

  return $result;
}

function update_lot_customer($lot_id, $cust_id) {
  global $db;

  $sql = 'UPDATE Lots ';
  $sql .= 'SET people_id=\'' . $cust_id . '\' ';
  $sql .= 'WHERE lot_id=\'' . $lot_id . '\'';

  $result = mysqli_query($db, $sql);

  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

/* Waitlist queries */

function add_to_waitlist($cust_id, $trailer_size, $lot_preference, $notes) {
  global $db;

  $sql = 'INSERT INTO Waitlist (people_id, trailer_size, lot_preference, notes) ';
  $sql .= 'VALUES (\'' . $cust_id . '\', \'' . $trailer_size . '\', \'' . $lot_preference . '\', \'' . $notes . '\'';

  $result = mysqli_query($db, $sql);
  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function remove_from_waitlist($cust_id) {







}

function transfer_from_waitlist($cust_id) {

}

/* Registration queries */

function reg_search_lastname($name) {
  global $db;

  $sql = 'SELECT lots.lot_id, lots.lot_name, people.last_name, people.first_name, people.people_id FROM people ';
  $sql .= 'INNER JOIN lots ON people.people_id = lots.people_id ';
  $sql .= 'WHERE people.last_name LIKE \'' . $name . '%\' ';
  $sql .= 'ORDER BY lots.lot_id ASC';

  $result = mysqli_query($db, $sql);
  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function reg_search_lotname($name) {
  global $db;

  $sql = 'SELECT lots.lot_id, lots.lot_name, people.last_name, people.first_name, people.people_id FROM lots ';
  $sql .= 'INNER JOIN people ON lots.people_id = people.people_id ';
  $sql .= 'WHERE lots.lot_name LIKE \'' . $name . '%\' ';
  $sql .= 'ORDER BY lots.lot_id ASC';

  $result = mysqli_query($db, $sql);

  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

// reg_lot_costs($lot_list) returns the total cost of the lots specified in the input
//  to be used in conjunction with reg_lot_payments() to determine what is owed at
//  registration time
// input: $lot_list - array of lot_ids
// output: sum of lot values
function reg_lot_costs($lot_list) {
  global $db;

  $sql = 'SELECT SUM(lot_value) FROM lots WHERE ';
  $sql .= 'lot_id IN (';
  foreach ($lot_list as $lot_id) {
    $sql .= "\'$lot_id\'";
  }
  $sql .= ')';

  $result = mysqli_query($db, $sql);

  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

// reg_lot_payments($lot_list) returns the total payments that were made on each
//  of the lots in $lot_list for preregistration. To be used in conjunction with
//  reg_lot_costs() to determine what is owed at registration time.
// input: $lot_list - array of lot_ids
// output: sum of preregistration payments made on lots
function reg_lot_payments($lot_list) {
  global $db;
  global $reg_year;

  $sql = 'SELECT SUM(payment_amount) FROM payments WHERE ';
  $sql .= 'lot_id IN (';
  foreach ($lot_list as $lot_id) {
    $sql .= "\'$lot_id\'";
  }
  $sql .= ") AND year_paid = \'$reg_year\'";

  $result = mysqli_query($db, $sql);

  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

// in progress
function reg_lot_list($lot_list) {
  global $db;
  global $reg_year;

  $sql = 'SELECT lots.lot_id,lots.lot_name,payments.payment_id,payments.payment_amount,payments.payment_date ';
  $sql .= 'FROM lots LEFT JOIN payments ON lots.lot_id=payments.lot_id WHERE ';
  $sql .= 'lots.lot_id IN (';
  foreach ($lot_list as $lot_id) {
    $sql .= "'$lot_id',";
  }
  $sql = rtrim($sql,",");
  $sql .= ") AND ((payment_type = 'preregistration' "; // still needs work, this will exclude a lot with an old prepayment
  $sql .= "AND year_paid = '$reg_year') ";
  $sql .= "OR payment_type IS NULL)"; // this condition ensures that records for
                                      //  lots with no prepayments are returned

  echo $sql; // testing purposes, remove in production

  $result = mysqli_query($db, $sql);

  if ($result) {
    return $result;
  }
  else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
?>
