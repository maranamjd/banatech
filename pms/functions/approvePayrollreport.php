<?php
include 'db.php';
include 'function.php';
if (isset($_POST['send'])) {
  $day = date('j');
  $month = date('n');
  $year = date('Y');
  if($day >= 1 && $day <= 15)
  $batch = 1;
  else
  $batch = 2;

      $statement = $connection->prepare('
      UPDATE payrolls SET isApproved = 1 WHERE Month = :month AND Year = :year AND Batch = :batch
      ');
      $result = $statement->execute(array(
        ':month' => $month,
        ':year' => $year,
        ':batch' => $batch
      ));
      if ($result) {
        echo 'Payroll Report Approved.';
      }else {
        echo 'Payroll Report not Approved.';
      }

}else {
  header('Location: ../');
}
