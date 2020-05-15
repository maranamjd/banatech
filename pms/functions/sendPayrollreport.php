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

  $result = $mysqli->query("SELECT id FROM payrolls WHERE Month = '$month' AND Year = '$year' AND Batch = '$batch'");
  if ($result->num_rows == 0) {
      $statement = $connection->prepare('
      INSERT INTO payrolls (id, Month, Year, Batch, isApproved)
      VALUES (NULL, :month, :year, :batch, 0)
      ');
      $result = $statement->execute(array(
        ':month' => $month,
        ':year' => $year,
        ':batch' => $batch
      ));
      if ($result) {
        echo 'Payroll Report Sent.';
      }else {
        echo 'Payroll Report not sent. ';
      }
  }else {
    echo 'Payroll Report already sent.';
  }

}else {
  header('Location: ../');
}
