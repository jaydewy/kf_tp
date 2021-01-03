<?php
  require_once(PRIVATE_PATH . '/TCPDF/tcpdf.php');
  class TP_RECEIPT_PDF extends TCPDF {
    // Page header
    public function Header() {
      // Logo
      // $logo_path = K_PATH_IMAGES . 'kf_logo.png';
      // $this->Image($logo_path, 10, 10, 206, 90, 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);
  		// Set font
  		$this->SetFont('helvetica', 'B', 20);
      $this->SetY(15);
  		// Title
      $title = 'Kinmount Fair Trailer Park ' . '2020';
  		$this->Cell(0, 15, $title, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    // Page Footer
    public function Footer() {
      $this->SetFont('helvetica', '', 12);
      $this->SetY(-15);
      $footerText = 'Thanks for visiting the Kinmount Fair';
      $this->Cell(0,15,$footerText,0,false,'C',0,'',0,false,'M','M');
    }
    // Error function.
    // public function Error() {
    //   echo "There was a fatal error.";
    // }
  }
?>
