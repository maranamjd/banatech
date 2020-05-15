<?php
if (isset($_POST['view'])) {
  $day = date('j');
  $month = date('n');
  $year = date('Y');
  if($day >= 1 && $day <= 15)
  $batch = 1;
  else
  $batch = 2;
  $data = array();
  if (file_exists('../assets/files/payrollreports/Payroll-Report'.$year."-".$month."-".$batch.".xlsx")) {
    $data['year'] = $year;
    $data['month'] = $month;
    $data['batch'] = $batch;
    $data['data'] = 1;
  }else if(file_exists('../assets/files/payrollreports/Payroll-Report'.$year."-".$month."-".$batch."-.xlsx")){
    $data['year'] = $year;
    $data['month'] = $month;
    $data['batch'] = $batch;
    $data['data'] = 2;
  }else {
    $data['data'] = 0;
  }
  echo json_encode($data);
}else {
  header('Location: ../');
}
