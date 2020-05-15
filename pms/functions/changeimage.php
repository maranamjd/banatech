<?php
session_start();
include 'db.php';
include 'function.php';
if (isset($_SESSION['EmployeeId'])) {
  $id = $_SESSION['EmployeeId'];
  $currentimage = '../assets/upload/'.$_SESSION['image'];
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  $extArr = ['png','jpg','jpeg', 'gif'];

  if($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg'&& $ext != 'gif'){
    echo 1;
  }
  else {
    $new_name = rand() . '.' . $ext;
    $destination = '../assets/upload/' . $new_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    $statement = $connection->prepare('UPDATE employees SET image = :image WHERE EmployeeId = :id');
    $result = $statement->execute(array(
      ':image' => $new_name,
      ':id'    => $id
    ));
    if(!empty($result)){
      if($_SESSION['image'] != 'unknown.jpg')
        unlink($currentimage);
      echo 'Profile Changed.';
      $_SESSION['image'] = $new_name;
    }
  }
}
else {
  header('Location: ../');
}
