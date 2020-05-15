<?php
session_start();
if($_POST['data_id'] == 1)
{
  include('db.php');
  $id = $_SESSION['EmployeeId'];
  $query = "SELECT a.*, b.UserType, b.isActive, c.* FROM employees a inner join users b on a.EmployeeId = b.EmployeeId inner join additionals c on b.EmployeeId = c.EmployeeId WHERE b.isActive != 0 AND b.hasDTR != 1 ";
  $statement = $connection->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
  echo json_encode($result);
}else {
  header('Location: ../');
}
