<?php
session_start();
if($_POST['data_id'] == 1)
{
  include('db.php');
  $id = $_SESSION['EmployeeId'];
  $query = "SELECT a.image, a.EmployeeId, a.FirstName, a.MiddleName, a.LastName, b.hasPayslip FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE b.isActive = 1 ";
  $statement = $connection->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
  echo json_encode($result);
}else {
  header('Location: ../');
}
