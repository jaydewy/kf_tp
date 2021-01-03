<?php
  require_once('../../private/initialize.php');
  require_once(PRIVATE_PATH . '/TP_RECEIPT_PDF.php');
  // header('Content-Type: application/pdf');
  // echo('beginning');
  // if(is_post_request()) {
    // get form data from reg_payment.php
    $lot_ids = $_POST['lot_ids'];
    $lot_ids = unserialize(hd($lot_ids));
    $cust_id = $_POST['cust_id'];
    $cust_id = unserialize(hd($cust_id));
    $admit = $_POST['admit'];
    $admit = unserialize(hd($admit));
    $payment_method = $_POST['payment_method'];
    $chequeno = $_POST['chequeno'];
    $debit_digits = $_POST['debit_digits'];
    $cust = get_customer_by_id($cust_id);
    // get admission fees
    $adult_wknd_fee = get_fees('adult_weekend');
    $child_wknd_fee = get_fees('child_weekend');
    $adult_day_fee = get_fees('adult_daily');
    $child_day_fee = get_fees('child_daily');
    $vehicle_fee = get_fees('parking_daily');
    $grand_total = 0;
    // pdf receipt setup ------------------------------------------------------
    $pdf = new TP_RECEIPT_PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor(PDF_AUTHOR);
    $pdf->SetTitle(PDF_HEADER_TITLE);
    $pdf->SetSubject('Trailer Park Receipt');
    $pdf->SetKeywords('trailer park, receipt, Kinmount Fair');
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // pdf receipt data and data entry ----------------------------------------
    $pdf->AddPage();
    // $logo_path = K_PATH_IMAGES . 'kf_logo.png';
    // $pdf->Image($logo_path, 10, 50, 0, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Add Fair contact info to top left corner
    $contact_info = "P.O. BOX 238\nKINMOUNT, ON, K0M 2A0\nPHONE: 705-488-2871\nEMAIL: trailerpark@kinmountfair.net";
    $pdf->MultiCell(0,0,$contact_info,0,'L',false,0,'','',true,0,false,true,0,'T',false);
    // Add current date and time to top right corner
    $date = 'DATE: ' . date("D M j Y G:i:s a");
    $pdf->Cell(0,0,$date,0,1,'R',false,'',0,false);
    $txt = 'Lot';
    foreach ($lot_ids as $lot_id) {
      $lot = get_lot_by_id($lot_id);
      $lot_name = $lot['lot_name'];
      $txt .= ' ' . $lot_name;
    }
    $pdf->Cell(0,0,$txt,0,1,'R',false,'',0,false);
    // $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    // Add customer information
    $txt = '<b>CUSTOMER INFORMATION</b>';
    $pdf->writeHTMLCell(0,0,'','',$txt,0,1);
    $txt = 'NAME: ' . $cust['first_name'] . ' ' . $cust['last_name'] . "\n";
    $txt .= 'ADDRESS: ' . $cust['address'] . "\n";
    $txt .= 'CITY: ' . $cust['city'] . ', ' . $cust['prov'] . "\n";
    $txt .= 'POSTAL CODE: ' . $cust['postal_code'] . "\n";
    $pdf->MultiCell(110 - PDF_MARGIN_LEFT,0,$txt,0,'L',false,0,'','');
    $txt = 'TELEPHONE: ' . $cust['telephone'] . "\n";
    $txt .= 'CELL PHONE: ' . $cust['cell_phone'] . "\n";
    $txt .= 'EMAIL: ' . $cust['email'] . "\n";
    $txt .= 'GROUP: ';
    $pdf->MultiCell(0,0,$txt,0,'L',false,1,'','');
    $pdf->Ln(5);
    // Add HTML table with fee details
    // table header
$html = <<<EOT
<style>
  td.head {
    border: 1px solid black;
    text-align: center;
  }
  td.uline {
    border-bottom: 1px solid black;
  }
</style>
<table cellspacing="0" cellpadding="1" border="0">
  <tr>
    <td class="head" colspan="2"><b>DESCRIPTION</b></td>
    <td class="head"><b>AMOUNT</b></td>
  </tr>
EOT;
    // add details from each lot to table
foreach ($lot_ids as $lot_id) {
  $lot = get_lot_by_id($lot_id);
  $lot_name = $lot['lot_name'];
  $adult_wknd_admits = $admit["$lot_id"]['adult_wknd_admits'];
  $child_wknd_admits = $admit["$lot_id"]['child_wknd_admits'];
  $adult_day_admits = $admit["$lot_id"]['adult_day_admits'];
  $child_day_admits = $admit["$lot_id"]['child_day_admits'];
  $vehicle_admits = $admit["$lot_id"]['vehicle_admits'];
  $adult_wknd_sub = $admit["$lot_id"]['adult_wknd_admits']*$adult_wknd_fee;
  $child_wknd_sub = $admit["$lot_id"]['child_wknd_admits']*$child_wknd_fee;
  $adult_day_sub = $admit["$lot_id"]['adult_day_admits']*$adult_day_fee;
  $child_day_sub = $admit["$lot_id"]['child_day_admits']*$child_day_fee;
  $vehicle_sub = $admit["$lot_id"]['vehicle_admits']*$vehicle_fee;
  $admission_sub = $adult_wknd_sub + $child_wknd_sub + $adult_day_sub + $child_day_sub + $vehicle_sub;
  $lot_prepayment = get_payment($lot_id);
  $lot_value = $lot['lot_value'];
  $lot_owing = $lot_value - $lot_prepayment;
  $lot_sub = $admission_sub + $lot_owing;
  $grand_total += $lot_sub;
$html .= <<<EOT
<tr>
  <td colspan="3"><b>Lot $lot_name</b></td>
</tr>
<tr>
  <td>&nbsp;&nbsp;Lot Fee</td>
  <td></td>
  <td class="uline">$$lot_value</td>
</tr>
<tr>
  <td>&nbsp;&nbsp;Lot Fee Paid</td>
  <td></td>
  <td class="uline">($$lot_prepayment)</td>
</tr>
<tr>
  <td>&nbsp;&nbsp;Lot Fee Owing</td>
  <td></td>
  <td class="uline">$$lot_owing</td>
</tr>
<tr>
  <td colspan="2"><b>Admissions</b></td>
  <td></td>
</tr>
<tr>
  <td>&nbsp;&nbsp;Adult Weekend</td>
  <td class="uline">x$adult_wknd_admits @$adult_wknd_fee</td>
  <td class="uline">$$adult_wknd_sub</td>
</tr>
<tr>
  <td>&nbsp;&nbsp;Adult Day</td>
  <td class="uline">x$adult_day_admits @$adult_day_fee</td>
  <td class="uline">$$adult_day_sub</td>
</tr>
<tr>
  <td>&nbsp;&nbsp;Child Weekend</td>
  <td class="uline">x$child_wknd_admits @$child_wknd_fee</td>
  <td class="uline">$$child_wknd_sub</td>
</tr>
<tr>
  <td>&nbsp;&nbsp;Child Day</td>
  <td class="uline">x$child_day_admits @$child_day_fee</td>
  <td class="uline">$$child_day_sub</td>
</tr>
<tr>
  <td>&nbsp;&nbsp;Car Pass</td>
  <td class="uline">x$vehicle_admits @$vehicle_fee</td>
  <td class="uline">$$vehicle_sub</td>
</tr>
<tr>
  <td></td>
  <td>Lot $lot_name Subtotal</td>
  <td class="uline">$$lot_sub</td>
</tr>
EOT;
}
    // table footer
$html .= <<<EOT
<tr>
  <td></td>
  <td><b>GRAND TOTAL</b></td>
  <td class="uline"><b>$$grand_total</b></td>
</tr>
EOT;
$html .= "</table>";
    $pdf->writeHTML($html);
    // add payment details
    $txt = 'Payment Method: ' . ucfirst($payment_method);
    if ($payment_method == 'cheque') {
      $txt .= ' ' . 'No.' . $chequeno;
    }
    if ($payment_method == 'debit') {
      $txt .= ' ' . $debit_digits;
    }
    $pdf->Cell(0,0,$txt,0,true,'L');
    $txt = 'Payment ID: ' . '';
    $pdf->Cell(0,0,$txt,0,true,'L');
    // $file_name_out = '';
    $pdf->Output('TpReceipt.pdf', 'I'); // change filename to include payment ID etc, modify to FI to save copy to server
    // $pdf->Error('An error occurred.');
    // -------------------END PDF----------------------------------------------
    // data entry
    // need to print the PDF
    // need to redirect to registration mainpage
    // redirect_to(url_for('staff/registration.php'));
  // }
  // else {
  //   redirect_to(url_for('staff/registration.php'));
  // }
?>
