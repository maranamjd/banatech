<?php
include 'db.php';
if (isset($_POST['textfield'])) {


    $employeeid = $mysqli->escape_string($_POST['employeeid']);
    $email  = $mysqli->escape_string($_POST['email']);

    if ($_POST['textfield'] == 'email1') {
      $result = $mysqli->query("SELECT EmployeeId FROM employees WHERE Email = '$email'");

      if ( $result->num_rows == 0 ){ // User doesn't exist
        printf(0);
      }else {
        $row = $result->fetch_assoc();
        if ($row['EmployeeId'] == $employeeid) {
          printf(0);
        }else
          printf(1);
      }
    }else {
      $result = $mysqli->query("SELECT Email FROM employees WHERE EmployeeId = '$employeeid'");

      if ( $result->num_rows == 0 ){ // User doesn't exist
        $result = $mysqli->query("SELECT Email FROM employees WHERE Email = '$email'");

        if ( $result->num_rows == 0 ){ // User doesn't exist
          $data = 'inen';
        }
        else { // User exists
          $data = 'iney';
        }
      }
      else { // User exists
        $result = $mysqli->query("SELECT Email FROM employees WHERE Email = '$email'");

        if ( $result->num_rows == 0 ){ // User doesn't exist
          $data = 'iyen';
        }
        else { // User exists
          $data = 'iyey';
        }
      }

      printf($data);
    }

}
else {
  header('Location: ../');
}
