<?php
session_start();
include 'db.php';
if (isset($_POST['reset'])) {

  $statement = $connection->prepare('UPDATE users SET hasDTR = 0, hasLoans = 0, hasPayslip = 0 WHERE hasPayslip = 1');
  $result = $statement->execute();

  if ($result) {
    unset($_SESSION['reseton']);
    unset($_SESSION['reporton']);
  }

}else {
  header('Location: ../');
}
