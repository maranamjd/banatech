<?php
include 'db.php';
include 'function.php';

if(isset($_POST['id'])){
  $id = $_POST['id'];
  $newpass = $_POST['newpass'];
  $confirmpass = $_POST['confirmpass'];
  if ($newpass != $confirmpass) {
    echo 1;
  }
  else {
    $statement = $connection->prepare("UPDATE users SET Password = :newpass, hash = :newhash WHERE EmployeeId = :id");
    $result = $statement->execute(array(
      ':newpass' => encryptIt($newpass),
      ':newhash' => $mysqli->escape_string( md5( rand(0,1000000) ) ),
      ':id'      => $id
    ));
    if($result){
      echo 2;
    }
    else {
      echo 3;
    }
  }
}
else {
  header('Location: ../');
}
