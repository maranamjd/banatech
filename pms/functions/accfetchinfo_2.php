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

  $query = "SELECT a.image, a.EmployeeId, a.FirstName, a.MiddleName, a.LastName, b.hasLoans FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE b.isActive = 1 ";
  $statement = $connection->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
  echo json_encode($result);

  $result = $mysqli->query("SELECT id FROM payrolls WHERE Month = '$month' AND Year = '$year' AND Batch = '$batch' AND isApproved = 0");

  if ($result->num_rows != 0) {
    $_SESSION['reporton'] = true;
  }else {
    if (isset($_SESSION['reporton'])) {
      unset($_SESSION['reporton']);
    }
  }
}else {
  header('Location: ../');
}
