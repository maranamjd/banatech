<?php
	session_start();
	include 'function.php';
	include 'db.php';
if(isset($_POST['firstname'])){
	$firstname 	= $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname 	= $_POST['lastname'];
	$email			= $_POST['email'];
	$EmployeeId = $_SESSION['EmployeeId'];

	$statement = $connection->prepare("UPDATE employees SET FirstName = :FirstName, MiddleName = :MiddleName, LastName = :LastName, Email = :Email WHERE EmployeeId = :EmployeeId");
	$result = $statement->execute(
		array(
			':FirstName'  => $firstname,
			':MiddleName' => $middlename,
			':LastName' 	=> $lastname,
			':Email' 		 	=> $email,
			':EmployeeId'	=> $EmployeeId
		));

		if($result){
			echo 'Profile Changed.';
			$_SESSION['FirstName'] = $firstname;
			$_SESSION['MiddleName'] = $middlename;
			$_SESSION['LastName'] = $lastname;
			$_SESSION['Name'] = $firstname.' '.ucfirst($middlename{0}).'. '.$lastname;
			$_SESSION['Email'] = $email;
		}else {
			echo 'Unable to Change Profile.';
		}
}
else {
  header('Location: ../');
}
