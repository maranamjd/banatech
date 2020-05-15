<?php
if (isset($_GET['filename'])) {
  $filename = $_GET['filename'];

  if ($filename == 0) {
    $filename = '../assets/files/downloadfiles/EmployeeUploadTemplate.xlsx';
    $subfilename = 'EmployeeUploadTemplate.xlsx';
  }elseif ($filename == 1) {
    $filename = '../assets/files/downloadfiles/LoansUploadTemplate.xlsx';
    $subfilename = 'LoansUploadTemplate.xlsx';
  }elseif ($filename == 2)  {
    $year = $_GET['year'];
    $month = $_GET['month'];
    $batch = $_GET['batch'];
    $filename = '../assets/files/payrollreports/Payroll-Report'.$year."-".$month."-".$batch.".xlsx";
    $subfilename = 'Payroll-Report '.$year."-".$month."-".$batch.".xlsx";
  }elseif ($filename == 3)  {
    $year = $_GET['year'];
    $month = $_GET['month'];
    $batch = $_GET['batch'];
    $filename = '../assets/files/payrollreports/Payroll-Report'.$year."-".$month."-".$batch."-.xlsx";
    $subfilename = 'Payroll-Report '.$year."-".$month."-".$batch.".xlsx";
  }
  $filepath = $filename;
  if (!empty($filename) && file_exists($filepath)) {
    header('Cache-Control: public');
    header('Content-Description: File Transfer');
    header("Content-Disposition: attachment; filename=$subfilename");
    header('Content-Type: application/zip');
    header('Content-Transfer-Encoding: binary');
    readfile($filepath);
    exit;
  }
}
