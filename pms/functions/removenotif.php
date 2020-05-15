<?php
session_start();

include 'db.php';
if(isset($_POST['accss'])){
  if ($_POST['notifid'] != '') {
    $statement = $connection->prepare('UPDATE notifications SET Status = 1 WHERE id = :id');
    $result = $statement->execute(array(':id' => $_POST['notifid']));
  }
  echo $_SESSION['usertype'];
}else {
  header('Location: ../');
}
