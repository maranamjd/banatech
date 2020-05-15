<?php
require('../classes/fpdf.php');
include 'db.php';
include 'function.php';
if (isset($_POST['employeeid'])) {
  $id = $_POST['employeeid'];
  $name = $_POST['name'];
  $newname = str_replace('ñ', 'Ñ', $name);
  $payout = $_POST['payoutdate'];
  $basis = $_POST['basis'];
  $monthly = $_POST['monthly'];
  $daily = $_POST['daily'];
  $hourly = $_POST['hourly'];
  $netpay = $_POST['netpay'];
  $basicpay = $_POST['basicpay'];
  $absences = $_POST['absences'];
  $tardiness = $_POST['tardiness'];
  $undertime = $_POST['undertime'];
  $adjustments = $_POST['adjustments'];
  $grosstaxablepay = $_POST['grosstaxablepay'];
  $ssscontribution = $_POST['ssscontribution'];
  $philhealthcontribution = $_POST['philhealthcontribution'];
  $hdmfcontribution = $_POST['hdmfcontribution'];
  $totaldeductionsbeforetax = $_POST['totaldeductionsbeforetax'];
  $totaltaxableincome = $_POST['totaltaxableincome'];
  $withholdingtax = $_POST['withholdingtax'];
  $hdmfloan = $_POST['hdmfloan'];
  $sssloan = $_POST['sssloan'];
  $otherdeductions = $_POST['otherdeductions'];
  $totaldeductions = $_POST['totaldeductions'];
  $deminimis = $_POST['deminimis'];
  $allowance = $_POST['allowance'];
  $incentives = $_POST['incentives'];
  $total = $_POST['total'];

  try {
    $pdf = new FPDF();
    $pdf->AddPage();
    $cell_arr=array(50,40,25,20);
    $pdf->Image("../assets/img/banate2.png", 55, null, 110);
    $pdf->AddFont('Calibri','','Calibri.php');
    $pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
    $pdf->SetFont('Calibri Bold','B',11);
    $pdf->SetLeftMargin(40);
    $pdf->SetTopMargin(40);
    $pdf->SetFillColor(221,235,247);
    $pdf->Cell(135,6,'BANATECH',0,1,'C',true);
    //onerow
    $pdf->Cell($cell_arr[0],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[1],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);
    //one row
    $pdf->SetFont('Calibri','',10);
    $pdf->Cell(60,5,'EMPLOYEE NAME',0,0,'L',true);
    $pdf->SetFont('Calibri Bold','B',10);
    $pdf->Cell(60,5,strtoupper($newname),0,0,'',true);
    $pdf->Cell(10,5,' ',0,0,'',true);
    $pdf->Cell(5,5,' ',0,1,'',true);
    //onerow
    $pdf->SetFont('Calibri','',10);
    $pdf->Cell(60,5,'PAYOUT DATE',0,0,'L',true);
    $pdf->SetFont('Calibri Bold','B',10);
    $pdf->Cell(60,5,strtoupper($payout),0,0,'',true);
    $pdf->Cell(10,5,' ',0,0,'',true);
    $pdf->Cell(5,5,' ',0,1,'',true);
    //onerow
    $pdf->SetFont('Calibri','',10);
    $pdf->Cell(60,5,'Basis of deductions and premium pay',0,0,'L',true);
    $pdf->SetFont('Calibri Bold','B',10);
    $pdf->Cell(60,5,strtoupper($basis),0,0,'',true);
    $pdf->Cell(10,5,' ',0,0,'',true);
    $pdf->Cell(5,5,' ',0,1,'',true);
    //onerow
    $pdf->Cell($cell_arr[0],5,' ','B',0,'',true);
    $pdf->Cell($cell_arr[1],5,' ','B',0,'',true);
    $pdf->Cell($cell_arr[2],5,' ','B',0,'',true);
    $pdf->Cell($cell_arr[3],5,' ','B',1,'',true);
    //onerow
    $pdf->SetFont('Calibri Bold','B',10);
    $pdf->Cell($cell_arr[0],5,'TAXABLE INCOME','T',0,'L',true);
    $pdf->Cell($cell_arr[1],5,' ','T',0,'',true);
    $pdf->Cell($cell_arr[2],5,' ','T',0,'',true);
    $pdf->Cell($cell_arr[3],5,' ','T',1,'',true);
    //onerow
    $pdf->SetFont('Calibri','',10);
    $pdf->Cell($cell_arr[0],5,'Basic Pay',0,0,'L',true);
    $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
    $pdf->Cell($cell_arr[3],5,$basicpay,0,1,'R',true);
    //onerow
    if($absences != 0){
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell($cell_arr[0],5,'Absences',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,'Hr/s',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$absences,0,1,'R',true);
    }
    //onerow
    if ($tardiness != 0) {
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell($cell_arr[0],5,'Tardiness',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,'Min/s',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$tardiness,0,1,'R',true);
    }
    //onerow
    if ($undertime != 0) {
      $pdf->Cell($cell_arr[0],5,'Undertime',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,'Min/s',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$undertime,0,1,'R',true);
    }
    //onerow
    if ($adjustments != 0) {
      $pdf->SetFont('Calibri','',10);
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell($cell_arr[0],5,'Adjustments',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$adjustments,0,1,'R',true);
    }
    //onerow
    $pdf->SetFont('Calibri','',10);
    $pdf->Cell($cell_arr[0],5,'   Gross Taxable Pay',0,0,'L',true);
    $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
    $pdf->Cell($cell_arr[3],5,$grosstaxablepay,0,1,'R',true);
    //onerow
    $pdf->Cell($cell_arr[0],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[1],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);
    //onerow
    $pdf->SetFont('Calibri Bold','B',10);
    $pdf->Cell($cell_arr[0],5,'LESS:',0,0,'L',true);
    $pdf->Cell($cell_arr[1],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);
    //onerow
    if ($ssscontribution != 0) {
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell($cell_arr[0],5,'SSS Contribution',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$ssscontribution,0,1,'R',true);
    }
    //onerow
    if ($philhealthcontribution != 0) {
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell($cell_arr[0],5,'Philhealth Contribution',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$philhealthcontribution,0,1,'R',true);
    }
    //onerow
    if ($hdmfcontribution != 0) {
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell($cell_arr[0],5,'HDMF Contribution',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$hdmfcontribution,0,1,'R',true);
    }
    //onerow
    $pdf->SetFont('Calibri','',10);
    $pdf->Cell($cell_arr[0],5,'Total Deductions Before Tax',0,0,'L',true);
    $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
    $pdf->Cell($cell_arr[3],5,$totaldeductionsbeforetax,0,1,'R',true);
    //onerow
    $pdf->SetFont('Calibri','',10);
    $pdf->Cell($cell_arr[0],5,'Total Taxable Income',0,0,'L',true);
    $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
    $pdf->Cell($cell_arr[3],5,$totaltaxableincome,0,1,'R',true);

    //onerow
    $pdf->Cell($cell_arr[0],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[1],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);

    //onerow
    if ($totaldeductions != 0) {
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell($cell_arr[0],5,'DEDUCTIONS:',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
      $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);
      //onerow
      if ($withholdingtax != 0) {
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell($cell_arr[0],5,'Withholding Tax',0,0,'L',true);
        $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[3],5,$withholdingtax,0,1,'R',true);
      }
      //onerow
      if ($hdmfloan != 0) {
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell($cell_arr[0],5,'HDMF Loan',0,0,'L',true);
        $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[3],5,$hdmfloan,0,1,'R',true);
      }
      //onerow
      if ($sssloan != 0) {
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell($cell_arr[0],5,'SSS Salary Loan',0,0,'L',true);
        $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[3],5,$sssloan,0,1,'R',true);
      }
      //onerow
      if ($otherdeductions != 0) {
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell($cell_arr[0],5,'Other Deductions',0,0,'L',true);
        $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[3],5,$otherdeductions,0,1,'R',true);
      }
    //onerow
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell($cell_arr[0],5,'Total Deductions',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$totaldeductions,0,1,'R',true);
      //onerow
      $pdf->Cell($cell_arr[0],5,' ',0,0,'',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
      $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);
    }

    if ($total != 0) {
      //onerow
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell($cell_arr[0],5,'ADD:',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
      $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);
      //onerow
      if ($deminimis != 0) {
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell($cell_arr[0],5,'DE MINIMIS',0,0,'L',true);
        $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[3],5,$deminimis,0,1,'R',true);
      }
      //onerow
      if ($allowance != 0) {
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell($cell_arr[0],5,'TRAVEL AND MEAL ALLOWANCE',0,0,'L',true);
        $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[3],5,$allowance,0,1,'R',true);
      }
      //onerow
      if ($incentives != 0) {
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell($cell_arr[0],5,'INCENTIVES',0,0,'L',true);
        $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
        $pdf->Cell($cell_arr[3],5,$incentives,0,1,'R',true);
      }
      //onerow
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell($cell_arr[0],5,'   Total',0,0,'L',true);
      $pdf->Cell($cell_arr[1],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[2],5,' ',0,0,'L',true);
      $pdf->Cell($cell_arr[3],5,$total,0,1,'R',true);
      //onerow
      $pdf->Cell($cell_arr[0],5,' ','B',0,'',true);
      $pdf->Cell($cell_arr[1],5,' ','B',0,'',true);
      $pdf->Cell($cell_arr[2],5,' ','B',0,'',true);
      $pdf->Cell($cell_arr[3],5,' ','B',1,'',true);
    }
    //onerow
    $pdf->SetFont('Calibri Bold','B',10);
    $pdf->Cell($cell_arr[0],5,'NET PAY','BT',0,'L',true);
    $pdf->Cell($cell_arr[1],5,' ','BT',0,'',true);
    $pdf->Cell($cell_arr[2],5,' ','BT',0,'',true);
    $pdf->Cell($cell_arr[3],5,$netpay,'BT',1,'R',true);
    //onerow
    $pdf->Cell($cell_arr[0],5,' ','T',0,'',true);
    $pdf->Cell($cell_arr[1],5,' ','T',0,'',true);
    $pdf->Cell($cell_arr[2],5,' ','T',0,'',true);
    $pdf->Cell($cell_arr[3],5,' ','T',1,'',true);
    //onerow
    $pdf->SetFont('Calibri','',10);
    $pdf->Cell($cell_arr[0],5,'Monthly Rate',0,0,'',true);
    $pdf->Cell($cell_arr[1],5,$monthly,0,0,'R',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);
    //onerow
    $pdf->Cell($cell_arr[0],5,'Daily Rate',0,0,'',true);
    $pdf->Cell($cell_arr[1],5,$daily,0,0,'R',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);
    //onerow
    $pdf->Cell($cell_arr[0],5,'Hourly Rate',0,0,'',true);
    $pdf->Cell($cell_arr[1],5,$hourly,0,0,'R',true);
    $pdf->Cell($cell_arr[2],5,' ',0,0,'',true);
    $pdf->Cell($cell_arr[3],5,' ',0,1,'',true);

    $pdf->Output('../assets/files/payslips/'.$id.'-'.$payout.'.pdf','F');

    $statement = $connection->prepare('
    START TRANSACTION;
    INSERT INTO notifications (id, EmployeeId, Type)
    VALUES (NULL, :id, 1);
    UPDATE users SET hasPayslip = 1 WHERE EmployeeId = :id;
    COMMIT;');
    $result = $statement->execute(array(':id' => $id));
    echo $name."'s Payslip has been generated.";
  } catch (PDOException $e) {
    echo 'An Error Occured. '.$e;
  }
}
else {
  header('Location: ../');
}
