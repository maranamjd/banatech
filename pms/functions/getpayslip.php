<?php
session_start();
include 'function.php';
if (isset($_POST['date'])) {

  $id = $_SESSION['EmployeeId'];
  $date = date('F d, Y', strtotime($_POST['date']));
  echo json_encode($id.'-'.$date.'.pdf');
}else{
  header('Location: ../');
}
