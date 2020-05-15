<?php
session_start();
if($_POST['data_id'] == 1)
{
  include('db.php');
  $day = date('j');
  $month = date('n');
  $year = date('Y');
  if($day >= 1 && $day <= 15)
  $batch = 1;
  else
  $batch = 2;

  $query = "SELECT a.image, a.EmployeeId, a.FirstName, a.MiddleName, a.LastName, b.hasDTR, b.hasLoans, b.hasPayslip FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE b.isActive != 0";
  $statement = $connection->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
  $result2 = $mysqli->query("SELECT isApproved FROM payrolls WHERE Month = '$month' AND Year = '$year' AND Batch = '$batch'");
  $isApproved = '';
  if ($result2->num_rows != 0) {
    $row = $result2->fetch_assoc();
    $isApproved = $row['isApproved'];
  }

  $statement = $connection->prepare("SELECT count(hasPayslip) FROM users WHERE isActive = 1 AND hasPayslip = 0");
  $statement->execute();
  $result2 = $statement->fetchAll();
  if($result2[0]['count(hasPayslip)'] == 0){
    if ($day == 15 || $day == 30 || $day == 28 || $day == 29 || $day == 31 || $day == 14) {
      $reset = 1;
    }else {
      $reset = 0;
    }
  }else {
    $reset = 0;
  }


  $result4 = $mysqli->query("SELECT id FROM payrolls WHERE Month = '$month' AND Year = '$year' AND Batch = '$batch'");
  if ($result4->num_rows == 0) {
    $statement = $connection->prepare("SELECT count(EmployeeId) FROM users WHERE isActive = 1 AND hasDTR = 0 AND hasLoans = 0 OR isActive = 1 AND hasDTR = 1 AND hasLoans = 0 OR isActive = 1 AND hasDTR = 0 AND hasLoans = 1");
    $statement->execute();
    $result3 = $statement->fetchAll();
    if($result3[0]['count(EmployeeId)'] == 0){
      $report = 1;
    }else {
      $report = 0;
    }
  }else {
    $report = 0;
  }


  for ($i=0; $i < count($result); $i++) {
    $result[$i]['isApproved'] = $isApproved;
    $result[$i]['reset'] = $reset;
    $result[$i]['report'] = $report;
  }
  echo json_encode($result);


}else {
  header('Location: ../');
}
?>
