<?php
session_start();
include 'db.php';
if(isset($_POST['fetch'])){
  $query = "SELECT a.Image, a.EmployeeId, a.FirstName, a.MiddleName, a.LastName, b.isActive, b.hasDTR FROM employees a inner join users b on a.EmployeeId = b.EmployeeId WHERE b.isActive = 1 AND b.hasDTR = 0";

  $statement = $connection->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();


  echo json_encode($result);
}
else {
  header('Location: ../');
}
