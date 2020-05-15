<?php
	session_start();
	include 'function.php';
	include 'db.php';
if (isset($_POST['newpass'])) {
	$newpass 			= $_POST['newpass'];
	$confirmpass 	= $_POST['confirmpass'];
	$EmployeeId 	= $_SESSION['EmployeeId'];

	if($newpass == $confirmpass){

		$statement = $connection->prepare("UPDATE users SET Password = :Password WHERE EmployeeId = :EmployeeId");
		$result = $statement->execute(
			array(
				':EmployeeId'		=>	$EmployeeId,
				':Password' 		=> encrypt($newpass),
			));

			if($result){
				$_SESSION['Password'] = $newpass;
				echo 'Password Changed.';
			}else {
				echo 'Unable to Change Password.';
			}

		}else {
			echo 'Password do not match.';
		}
}
else {
  header('Location: ../');
}
