<?php

include('db.php');
include("function.php");

if(isset($_POST["employeeid"]))
{
	$statement = $connection->prepare("UPDATE users SET isActive = 1, Password = :Password WHERE EmployeeId = :id");
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["employeeid"],
      ':Password' => encryptIt($_POST['employeeid'].$_POST['email'])
		)
	);

	if(!empty($result))
	{
		echo 'Account has been activated. Passord has been reset to default';
	}
  else {
    echo 'Failed to activate account';
  }
}
else {
  header('Location: ../');
}
