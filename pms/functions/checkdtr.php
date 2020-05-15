<?php
session_start();
require_once "../classes/PHPExcel.php";
include 'db.php';
if (isset($_POST['date_from'])) {

  $statement = $connection->prepare('SELECT time_in, time_out, date_in FROM date_in_tbl WHERE emp_id = :id AND date_in BETWEEN :date_from AND :date_to');
  $statement->execute(array(':id' => $_SESSION['EmployeeId'], ':date_from' => $_POST['date_from'], ':date_to' => $_POST['date_to']));
  $dtr = $statement->fetchAll();


  echo json_encode($dtr);
}else {
  header('Location: ../');
}
