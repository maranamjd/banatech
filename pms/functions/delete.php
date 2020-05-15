<?php

include('db.php');
include("function.php");

if(isset($_POST["user_id"]))
{
	$statement = $connection->prepare("UPDATE users SET isActive = 0 WHERE EmployeeId = :id");
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);

	if(!empty($result))
	{
		echo 'Account Deactivated.';
	}
}
else {
  header('Location: ../');
}
